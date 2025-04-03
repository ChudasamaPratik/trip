<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class LegalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $legalPages = LegalPage::get();
                return DataTables::of($legalPages)
                    ->addIndexColumn()
                    ->addColumn('action', function ($legalPage) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('legal-page.edit', $legalPage->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('legal-page.destroy', $legalPage->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->editColumn('date', function ($legalPage) {
                        return Carbon::parse($legalPage->created_at)->format('d F, Y');
                    })
                    ->editColumn('type', function ($legalPage) {
                        $typeName = $legalPage->type == 'privacy_policy' ? 'Privacy Policy' : 'Terms of Use';
                        return  $typeName;
                    })
                    ->editColumn('description', function ($legalPage) {
                        return Str::limit(strip_tags($legalPage->description), 100);
                    })
                    ->addColumn('status_switch', function ($legalPage) {
                        $checked = $legalPage->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $legalPage->id . '" data-href="' . route('legal-page.change.status', $legalPage->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $legalPage->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.legal-page.index');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.pages.site.legal-page.create');
        } catch (Exception $e) {
            return redirect()->route('legal-page.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|string|in:privacy_policy,terms_of_use',
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string',
        ]);

        try {
            $legalPage = new LegalPage();
            $legalPage->id = Str::uuid();
            $legalPage->type = $request->type;
            $legalPage->title = $request->title;
            $legalPage->description = $request->description;
            $legalPage->status = 'active'; // Default status is active
            $legalPage->save();

            return redirect()->route('legal-page.index')
                ->with('success', 'Legal page created successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating legal page: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $legalPage = LegalPage::findOrFail($id);
            return view('backend.pages.site.legal-page.edit', compact('legalPage'));
        } catch (Exception $e) {
            return redirect()->route('legal-page.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|string|in:privacy_policy,terms_of_use',
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string',
        ]);

        try {
            $legalPage = LegalPage::findOrFail($id);
            $legalPage->type = $request->type;
            $legalPage->title = $request->title;
            $legalPage->description = $request->description;
            $legalPage->save();

            return redirect()->route('legal-page.index')
                ->with('success', 'Legal page updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating legal page: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $legalPage = LegalPage::findOrFail($id);
            $legalPage->delete();

            return response()->json([
                'success' => true,
                'message' => 'Legal page deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function changeStatus(string $id)
    {
        try {
            $legalPage = LegalPage::findOrFail($id);
            $legalPage->status = $legalPage->status == 'active' ? 'inactive' : 'active';
            $legalPage->save();

            return response()->json([
                'success' => true,
                'message' => 'Legal page status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change legal page status!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $faqs = Faq::get();
                return DataTables::of($faqs)
                    ->addIndexColumn()
                    ->addColumn('action', function ($faq) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('faq.edit', $faq->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('faq.destroy', $faq->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->editColumn('date', function ($faq) {
                        return Carbon::parse($faq->created_at)->format('d F, Y');
                    })
                    ->editColumn('question', function ($faq) {
                        return Str::limit($faq->question, 70);
                    })
                    ->editColumn('answer', function ($faq) {
                        return Str::limit(strip_tags($faq->answer), 100);
                    })
                    ->addColumn('status_switch', function ($faq) {
                        $checked = $faq->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $faq->id . '" data-href="' . route('faq.change.status', $faq->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $faq->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.faq.index');
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
            return view('backend.pages.site.faq.create');
        } catch (Exception $e) {
            return redirect()->route('faq.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'question' => 'required|string|min:5|max:255',
            'answer' => 'required|string',
        ]);

        try {
            $faq = new Faq();
            $faq->id = Str::uuid();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = 'active'; // Default status is active
            $faq->save();

            return redirect()->route('faq.index')
                ->with('success', 'FAQ created successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating FAQ: ' . $e->getMessage())
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
            $faq = Faq::findOrFail($id);
            return view('backend.pages.site.faq.edit', compact('faq'));
        } catch (Exception $e) {
            return redirect()->route('faq.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'question' => 'required|string|min:5|max:255',
            'answer' => 'required|string',
        ]);

        try {
            $faq = Faq::findOrFail($id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return redirect()->route('faq.index')
                ->with('success', 'FAQ updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating FAQ: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return response()->json([
                'success' => true,
                'message' => 'FAQ deleted successfully',
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
            $faq = Faq::findOrFail($id);
            $faq->status = $faq->status == 'active' ? 'inactive' : 'active';
            $faq->save();

            return response()->json([
                'success' => true,
                'message' => 'FAQ status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change FAQ status!'
            ]);
        }
    }
}

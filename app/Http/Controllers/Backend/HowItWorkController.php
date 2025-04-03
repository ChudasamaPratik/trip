<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HowItWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class HowItWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = HowItWork::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="' . route('how-does-it-work.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item delete" href="' . route('how-does-it-work.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>';
                        return $actions;
                    })
                    ->editColumn('description', function ($how) {
                        return Str::limit(strip_tags($how->description), 50);
                    })
                    ->addColumn('status_switch', function ($how) {
                        $checked = $how->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $how->id . '" data-href="' . route('how-does-it-work.change.status', $how->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $how->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.how-it-work.index');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.pages.site.how-it-work.create');
        } catch (\Exception $e) {
            return redirect()->route('how-does-it-work.index')->with('error', $e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',

        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
        ]);
        try {

            $howIt = new HowItWork();
            $howIt->id = Str::uuid();
            $howIt->title = $request->title;
            $howIt->description = $request->description;
            $howIt->save();

            return redirect()->route('how-does-it-work.index')->with('success', 'How Does it created successfully');
        } catch (\Exception $e) {
            return redirect()->route('how-does-it-work.index')->with('error', $e->getMessage());
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
            $How = HowItWork::find($id);
            return view('backend.pages.site.how-it-work.edit', compact('How'));
        } catch (\Exception $e) {
            return redirect()->route('how-does-it-work.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',

        ]);
        try {
            $how = HowItWork::findOrFail($id);
            $how->title = $request->title;
            $how->description = $request->description;
            $how->update();
            return redirect()->route('how-does-it-work.index')->with('success', 'How It Work updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('how-does-it-work.edit', $id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $How = HowItWork::findOrFail($id);
            $How->delete();

            return response()->json([
                'success' => true,
                'message' => 'How It Work deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function changeStatus($id)
    {
        try {
            $How = HowItWork::findOrFail($id);
            $How->status = $How->status == 'active' ? 'inactive' : 'active';
            $How->save();

            return response()->json([
                'success' => true,
                'message' => 'How It Work status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change About status!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BidTravelsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BidOnTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = BidTravelsSection::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="' . route('bid-on-travel.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item delete" href="' . route('bid-on-travel.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($Travel) {
                        return '<img src="' . ($Travel->image_url) . '" alt="' . $Travel->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($Travel) {
                        $checked = $Travel->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $Travel->id . '" data-href="' . route('bid-on-travel.change.status', $Travel->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $Travel->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.bid-on-travel.index');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.site.bid-on-travel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'main_title' => 'required|string|min:3|max:100',
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'main_title.required' => 'The title field is required.',
            'main_title.min' => 'The title must be at least 3 characters.',
            'main_title.max' => 'The title cannot be longer than 100 characters.',
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
            'image.required' => 'Please select an image for the slider.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);
        try {
            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();

            $imageName = time() . '.' . $extension;

            $image->storeAs('bidTravelSection', $imageName, 'public');

            $about = new BidTravelsSection();
            $about->id = Str::uuid();
            $about->main_title = $request->main_title;
            $about->title = $request->title;
            $about->description = $request->description;
            $about->image = $imageName;
            $about->save();

            return redirect()->route('bid-on-travel.index')->with('success', 'Bid travel created successfully');
        } catch (\Exception $e) {
            return redirect()->route('bid-on-travel.create')->with('error', $e->getMessage());
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
            $travelSection = BidTravelsSection::find($id);
            return view('backend.pages.site.bid-on-travel.edit', compact('travelSection'));
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'main_title' => 'required|string|min:3|max:100',
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'main_title.required' => 'The title field is required.',
            'main_title.min' => 'The title must be at least 3 characters.',
            'main_title.max' => 'The title cannot be longer than 100 characters.',
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'status.required' => 'The status field is required.',
        ]);

        try {
            $Travel = BidTravelsSection::findOrFail($id);
            $Travel->main_title = $request->main_title;
            $Travel->title = $request->title;
            $Travel->description = $request->description;

            if ($request->hasFile('image')) {
                if ($Travel->image) {
                    $oldImagePath = 'public/bidTravelSection/' . $Travel->image;
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $image->storeAs('bidTravelSection', $imageName, 'public');
                $Travel->image = $imageName;
            }
            $Travel->update();

            return redirect()->route('bid-on-travel.index')->with('success', 'Bid Travel updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('bid-on-travel.edit', $id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $Travel = BidTravelsSection::findOrFail($id);

            if ($Travel->image) {
                $imagePath = 'public/aboutSection/' . $Travel->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $Travel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bid Travel deleted successfully',
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
            $Travel = BidTravelsSection::findOrFail($id);
            $Travel->status = $Travel->status == 'active' ? 'inactive' : 'active';
            $Travel->save();

            return response()->json([
                'success' => true,
                'message' => 'Bid Travel status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change About status!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Bid::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="' . route('bid.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item delete" href="' . route('bid.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($bid) {
                        return '<img src="' . ($bid->image_url) . '" alt="' . $bid->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($bid) {
                        $checked = $bid->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $bid->id . '" data-href="' . route('bid.change.status', $bid->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $bid->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.bid.index');
        } catch (\Exception $e) {
            return redirect()->route('bid.index')->with('error', 'Something went wrong');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.site.bid.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'tour' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'tour.required' => 'The tour field is required.',
            'image.required' => 'Please select an image for the bid.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);
        try {
            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();

            $imageName = time() . '.' . $extension;

            $image->storeAs('bidsSection', $imageName, 'public');

            $bid = new Bid();
            $bid->id = Str::uuid();
            $bid->title = $request->title;
            $bid->price = $request->price;
            $bid->tour = $request->tour;
            $bid->image = $imageName;
            $bid->save();

            return redirect()->route('bid.index')->with('success', 'Bid created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('bid.create')->with('error', $e->getMessage());
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
            $bid = Bid::find($id);
            return view('backend.pages.site.bid.edit', compact('bid'));
        } catch (\Exception $e) {
            return redirect()->route('bid.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'tour' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'tour.required' => 'The tour field is required.',
            'image.required' => 'Please select an image for the bid.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);
        try {


            $bid = Bid::findOrFail($id);
            $bid->title = $request->title;
            $bid->price = $request->price;
            $bid->tour = $request->tour;
            if ($request->hasFile('image')) {
                if ($bid->image) {
                    $oldImagePath = 'public/bidsSection/' . $bid->image;
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $image->storeAs('bidsSection', $imageName, 'public');
                $bid->image = $imageName;
            }
            $bid->update();

            return redirect()->route('bid.index')->with('success', 'Bid update successfully.');
        } catch (\Exception $e) {
            return redirect()->route('bid.edit')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $bid = Bid::findOrFail($id);

            if ($bid->image) {
                $imagePath = 'public/bidsSection/' . $bid->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $bid->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bid deleted successfully',
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
            $bid = Bid::findOrFail($id);
            $bid->status = $bid->status == 'active' ? 'inactive' : 'active';
            $bid->save();

            return response()->json([
                'success' => true,
                'message' => 'bid status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change bid status!'
            ]);
        }
    }
}

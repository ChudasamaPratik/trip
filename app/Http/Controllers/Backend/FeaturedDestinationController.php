<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class FeaturedDestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        try {
            if ($request->ajax()) {
                $data = Destination::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('slider.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('slider.delete', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($slider) {
                        return '<img src="' . ($slider->image_url) . '" alt="' . $slider->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($slider) {
                        $checked = $slider->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $slider->id . '" data-href="' . route('slider.change.status', $slider->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $slider->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.featured-destination.index');
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
            return view('backend.pages.site.featured-destination.create');
        } catch (Exception $e) {
            return redirect()->route('featured-destination.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'hotel' => 'required|string|max:100',
            'rental' => 'required|string|max:100',
            'tour' => 'required|string|max:100',
            'activities' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $extension = $image->getClientOriginalExtension();

                $imageName = time() . '.' . $extension;

                // Create directory if it doesn't exist
                $destinationPath = 'featured-destinations';
                if (!Storage::exists('public/' . $destinationPath)) {
                    Storage::makeDirectory('public/' . $destinationPath);
                }

                $image->storeAs($destinationPath, $imageName, 'public');

                // Save only the file name to the database
                $imageFileName = $imageName;
            }


            // Create new featured destination
            $featuredDestination = new Destination();
            $featuredDestination->id = Str::uuid();
            $featuredDestination->name = $request->name;
            $featuredDestination->hotel_name = $request->hotel;
            $featuredDestination->rental = $request->rental;
            $featuredDestination->tour = $request->tour;
            $featuredDestination->activities = $request->activities;
            $featuredDestination->description = $request->description;
            $featuredDestination->image = $imageFileName;
            $featuredDestination->status = $request->status ?? 'active';
            $featuredDestination->save();

            return redirect()->route('featured-destination.index')
                ->with('success', 'Featured destination created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating featured destination: ' . $e->getMessage());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

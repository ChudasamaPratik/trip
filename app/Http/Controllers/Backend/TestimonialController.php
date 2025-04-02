<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $testimonials = Testimonial::get();
                return DataTables::of($testimonials)
                    ->addIndexColumn()
                    ->addColumn('action', function ($testimonial) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('testimonial.edit', $testimonial->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('testimonial.destroy', $testimonial->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->editColumn('date', function ($testimonial) {
                        return Carbon::parse($testimonial->created_at)->format('d F, Y');
                    })
                    ->addColumn('image', function ($testimonial) {
                        return '<img src="' . ($testimonial->image_url) . '" alt="' . $testimonial->first_name . ' ' . $testimonial->last_name . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('status_switch', function ($testimonial) {
                        $checked = $testimonial->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $testimonial->id . '" data-href="' . route('testimonial.change.status', $testimonial->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $testimonial->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.testimonial.index');
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
            return view('backend.pages.site.testimonial.create');
        } catch (Exception $e) {
            return redirect()->route('testimonial.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $testimonial = new Testimonial();
            $testimonial->id = Str::uuid();
            $testimonial->first_name = $request->first_name;
            $testimonial->last_name = $request->last_name;
            $testimonial->rating = $request->rating;
            $testimonial->description = $request->description;
            $testimonialImagePath = 'testimonials';

            if (!Storage::disk('public')->exists($testimonialImagePath)) {
                Storage::disk('public')->makeDirectory($testimonialImagePath);
            }

            if ($request->hasFile('image')) {
                $testimonialImage = $request->file('image');
                $testimonialImageExtension = $testimonialImage->getClientOriginalExtension();
                $testimonialImageName = 'testimonial_' . time() . '.' . $testimonialImageExtension;

                $testimonialImage->storeAs($testimonialImagePath, $testimonialImageName, 'public');
                $testimonial->image = $testimonialImageName;
            }

            $testimonial->status = 'active'; // Default status is active
            $testimonial->save();

            return redirect()->route('testimonial.index')
                ->with('success', 'Testimonial created successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating testimonial: ' . $e->getMessage())
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
            $testimonial = Testimonial::findOrFail($id);
            return view('backend.pages.site.testimonial.edit', compact('testimonial'));
        } catch (Exception $e) {
            return redirect()->route('testimonial.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->first_name = $request->first_name;
            $testimonial->last_name = $request->last_name;
            $testimonial->rating = $request->rating;
            $testimonial->description = $request->description;

            $testimonialImagePath = 'testimonials';

            if (!Storage::disk('public')->exists($testimonialImagePath)) {
                Storage::disk('public')->makeDirectory($testimonialImagePath);
            }

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($testimonial->image && Storage::disk('public')->exists($testimonialImagePath . '/' . $testimonial->image)) {
                    Storage::disk('public')->delete($testimonialImagePath . '/' . $testimonial->image);
                }

                $testimonialImage = $request->file('image');
                $testimonialImageExtension = $testimonialImage->getClientOriginalExtension();
                $testimonialImageName = 'testimonial_' . time() . '.' . $testimonialImageExtension;

                $testimonialImage->storeAs($testimonialImagePath, $testimonialImageName, 'public');
                $testimonial->image = $testimonialImageName;
            }

            $testimonial->save();

            return redirect()->route('testimonial.index')
                ->with('success', 'Testimonial updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating testimonial: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            if ($testimonial->image) {
                $testimonialImagePath = 'public/testimonials/' . $testimonial->image;
                if (Storage::exists($testimonialImagePath)) {
                    Storage::delete($testimonialImagePath);
                }
            }

            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully',
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
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->status = $testimonial->status == 'active' ? 'inactive' : 'active';
            $testimonial->save();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change testimonial status!'
            ]);
        }
    }
}

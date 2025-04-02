<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function sliderIndex(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Slider::get();
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
            return view('backend.pages.site.slider.index');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    public function sliderCreate()
    {
        try {
            return view('backend.pages.site.slider.create');
        } catch (Exception $e) {
            return redirect()->route('slider.index')->with('error', 'Something went wrong');
        }
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
            'description.max' => 'The description cannot be longer than 500 characters.',
            'image.required' => 'Please select an image for the slider.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);
        try {
            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();

            $imageName = time() . '.' . $extension;

            $image->storeAs('slider', $imageName, 'public');

            $slider = new Slider();
            $slider->id =  Str::uuid();
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->image = $imageName;
            $slider->save();

            return redirect()->route('slider.index')->with('success', 'Slider created successfully');
        } catch (Exception $e) {
            return redirect()->route('slider.create')->with('error', 'Something went wrong');
        }
    }

    public function sliderEdit($id)
    {
        try {
            $slider = Slider::find($id);
            return view('backend.pages.site.slider.edit', compact('slider'));
        } catch (Exception $e) {
            return redirect()->route('slider.index')->with('error', 'Something went wrong');
        }
    }


    public function sliderUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
            'description.max' => 'The description cannot be longer than 500 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'status.required' => 'The status field is required.',
        ]);

        try {
            $slider = Slider::findOrFail($id);
            $slider->title = $request->title;
            $slider->description = $request->description;

            if ($request->hasFile('image')) {
                if ($slider->image) {
                    $oldImagePath = 'public/slider/' . $slider->image;
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $image->storeAs('slider', $imageName, 'public');
                $slider->image = $imageName;
            }

            $slider->update();

            return redirect()->route('slider.index')->with('success', 'Slider updated successfully');
        } catch (Exception $e) {
            return redirect()->route('slider.edit', $id)->with('error', 'Something went wrong');
        }
    }

    public function sliderDelete($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            if ($slider->image) {
                $imagePath = 'public/slider/' . $slider->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $slider->delete();

            return response()->json([
                'success' => true,
                'message' => 'Slider deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function changeStatus($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->status = $slider->status == 'active' ? 'inactive' : 'active';
            $slider->save();

            return response()->json([
                'success' => true,
                'message' => 'Slider status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change slider status!'
            ]);
        }
    }
}

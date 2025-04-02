<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = AboutSection::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="btn-group" role="group">';
                        $actions .= '<a href="' . route('about.edit', $row->id) . '" class="btn btn-sm btn-outline-primary mr-1"  title="Edit">
                                        <i class="bi bi-pencil"></i>
                                     </a>';
                        $actions .= '<a href="' . route('about.delete', $row->id) . '" class="btn btn-sm btn-outline-danger delete"  title="Delete">
                                        <i class="bi bi-trash"></i>
                                     </a>';
                        $actions .= '</div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($about) {
                        return '<img src="' . ($about->image_url) . '" alt="' . $about->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($about) {
                        $checked = $about->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $about->id . '" data-href="' . route('about.change.status', $about->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $about->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.about.index');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }


    }

    public function create()
    {
        try {
            return view('backend.pages.about.create');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }
    }
    public function Store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'main_title' => 'required|string|min:3|max:100',
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'main_title.required' => 'The title field is required.',
            'main_title.min' => 'The title must be at least 3 characters.',
            'main_title.max' => 'The title cannot be longer than 100 characters.',
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

            $image->storeAs('aboutSection', $imageName, 'public');

            $about = new AboutSection();
            $about->main_title = $request->main_title;
            $about->title = $request->title;
            $about->description = $request->description;
            $about->image = $imageName;
            // dd($about);
            $about->save();

            return redirect()->route('about.index')->with('success', 'About created successfully');
        } catch (\Exception $e) {
            return redirect()->route('about.create')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $slider = AboutSection::find($id);
            return view('backend.pages.about.edit', compact('slider'));
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'main_title' => 'required|string|min:3|max:100',
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'main_title.required' => 'The title field is required.',
            'main_title.min' => 'The title must be at least 3 characters.',
            'main_title.max' => 'The title cannot be longer than 100 characters.',
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title cannot be longer than 100 characters.',
            'description.max' => 'The description cannot be longer than 500 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'status.required' => 'The status field is required.',
        ]);

        try {
            $about = AboutSection::findOrFail($id);
            $about->main_title = $request->main_title;
            $about->title = $request->title;
            $about->description = $request->description;

            if ($request->hasFile('image')) {
                if ($about->image) {
                    $oldImagePath = 'public/aboutSection/' . $about->image;
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $image->storeAs('aboutSection', $imageName, 'public');
                $about->image = $imageName;
            }
            $about->update();

            return redirect()->route('about.index')->with('success', 'About updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('about.edit', $id)->with('error', 'Something went wrong');
        }
    }
    public function delete($id)
    {
        try {
            $slider = AboutSection::findOrFail($id);

            if ($slider->image) {
                $imagePath = 'public/aboutSection/' . $slider->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $slider->delete();

            return response()->json([
                'success' => true,
                'message' => 'About deleted successfully',
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
            $about = AboutSection::findOrFail($id);
            $about->status = $about->status == 'active' ? 'inactive' : 'active';
            $about->save();

            return response()->json([
                'success' => true,
                'message' => 'About status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change About status!'
            ]);
        }
    }


}

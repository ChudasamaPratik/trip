<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Blog::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('blog.edit', $row->id) . '">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>
                                            <a class="dropdown-item delete" href="' . route('blog.destroy', $row->id) . '">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($tipsTravel) {
                        return '<img src="' . ($tipsTravel->image_url) . '" alt="' . $tipsTravel->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($tipsTravel) {
                        $checked = $tipsTravel->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $tipsTravel->id . '" data-href="' . route('blog.change.status', $tipsTravel->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $tipsTravel->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.blog.index');
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
            return view('backend.pages.site.blog.create');
        } catch (Exception $e) {
            return redirect()->route('blog.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|min:3|max:200',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'content' => 'required|string',
        ]);

        try {
            $blog = new Blog();
            $blog->id = Str::uuid();
            $blog->title = $request->title;
            $blog->description = $request->content;
            $destinationPath = 'blog';

            if (!Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = 'blog_' . time() . '.' . $imageExtension;

                $image->storeAs($destinationPath, $imageName, 'public');
                $blog->image = $imageName;
            }

            $blog->save();

            return redirect()->route('blog.index')
                ->with('success', 'Blog post created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating blog post: ' . $e->getMessage())
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
            $blog = Blog::findOrFail($id);
            return view('backend.pages.site.blog.edit', compact('blog'));
        } catch (Exception $e) {
            return redirect()->route('tips-and-travels.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|min:3|max:200',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'content' => 'required|string',
        ]);

        try {
            $blog = Blog::findOrFail($id);
            $blog->title = $request->title;
            $blog->description = $request->content;
            $destinationPath = 'blog';

            if (!Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            if ($request->hasFile('image')) {
                if ($blog->image && Storage::disk('public')->exists($destinationPath . '/' . $blog->image)) {
                    Storage::disk('public')->delete($destinationPath . '/' . $blog->image);
                }

                $image = $request->file('image');
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = 'blog_' . time() . '.' . $imageExtension;

                $image->storeAs($destinationPath, $imageName, 'public');
                $blog->image = $imageName;
            }

            $blog->save();

            return redirect()->route('blog.index')
                ->with('success', 'Blog post updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating blog post: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->image) {
                $imagePath = 'public/blog/' . $blog->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog deleted successfully',
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
            $blog = Blog::findOrFail($id);
            $blog->status = $blog->status == 'active' ? 'inactive' : 'active';
            $blog->save();

            return response()->json([
                'success' => true,
                'message' => 'Blog status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change Blog status!'
            ]);
        }
    }
}

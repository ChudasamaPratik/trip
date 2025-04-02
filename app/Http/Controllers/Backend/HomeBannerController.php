<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = HomeBanner::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('home-banner.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('home-banner.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($banner) {
                        return '<img src="' . ($banner->image_url) . '" alt="' . $banner->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($banner) {
                        $checked = $banner->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $banner->id . '" data-href="' . route('home-banner.change.status', $banner->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $banner->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.home-banner.index');
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
            $exists = [
                'top' => HomeBanner::where('type', 'top')->exists(),
                'bottom' => HomeBanner::where('type', 'bottom')->exists()
            ];

            return view('backend.pages.site.home-banner.create', compact('exists'));
        } catch (Exception $e) {
            return redirect()->route('home-banner.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:top,bottom',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $extension = $image->getClientOriginalExtension();

                $imageName = time() . '.' . $extension;

                $destinationPath = 'home-banners';
                if (!Storage::exists('public/' . $destinationPath)) {
                    Storage::makeDirectory('public/' . $destinationPath);
                }

                $image->storeAs($destinationPath, $imageName, 'public');

                $imageFileName = $imageName;
            }

            $banner = new HomeBanner();
            $banner->id = Str::uuid();
            $banner->type = $request->type;
            $banner->image = $imageFileName;
            $banner->save();

            return redirect()->route('home-banner.index')
                ->with('success', 'Home banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating home banner: ' . $e->getMessage());
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
            $banner = HomeBanner::find($id);
            return view('backend.pages.site.home-banner.edit', compact('banner'));
        } catch (Exception $e) {
            return redirect()->route('home-banner.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|in:top,bottom',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $banner = HomeBanner::findOrFail($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;

                $destinationPath = 'home-banners';
                if (!Storage::exists('public/' . $destinationPath)) {
                    Storage::makeDirectory('public/' . $destinationPath);
                }

                if ($banner->image && Storage::exists('public/' . $destinationPath . '/' . $banner->image)) {
                    Storage::delete('public/' . $destinationPath . '/' . $banner->image);
                }

                $image->storeAs($destinationPath, $imageName, 'public');

                $banner->image = $imageName;
            }

            $banner->type = $request->type;
            $banner->save();

            return redirect()->route('home-banner.index')
                ->with('success', 'Home banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating home banner: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = HomeBanner::findOrFail($id);

            if ($banner->image) {
                $imagePath = 'public/home-banners/' . $banner->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $banner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Home banner deleted successfully',
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
            $banner = HomeBanner::findOrFail($id);
            $banner->status = $banner->status == 'active' ? 'inactive' : 'active';
            $banner->save();

            return response()->json([
                'success' => true,
                'message' => 'Home banner status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change home banner status!'
            ]);
        }
    }
}
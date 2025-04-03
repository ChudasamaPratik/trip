<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use DB;
class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Auction::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item show" href="' . route('auction.show', $row->id) . '" ><i class="dw dw-eye-3"></i>Show</a>
                            <a class="dropdown-item" href="' . route('auction.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item delete" href="' . route('auction.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($auction) {
                        return '<img src="' . ($auction->image_url) . '" alt="' . $auction->title . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($auction) {
                        $checked = $auction->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $auction->id . '" data-href="' . route('auction.change.status', $auction->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $auction->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.auction.index');
        } catch (\Exception $e) {
            return redirect()->route('auction.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.site.auction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'price' => 'required|string|max:100',
            'days' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description1' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description2' => 'required|string',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);

        try {
            $auction = new Auction();
            $auction->id = Str::uuid();
            $auction->title = $request->title;
            $auction->price = $request->price;
            $auction->days = $request->days;
            $auction->description1 = $request->description1;
            $auction->description2 = $request->description2;
            $auction->status = $request->status ?? 'active';

            // Handle image uploads
            $auction->image = $this->uploadImage($request->file('image'));
            $auction->image1 = $this->uploadImage($request->file('image1'));
            $auction->image2 = $this->uploadImage($request->file('image2'));

            $auction->save();
            return redirect()->route('auction.index')->with('success', "Auction created successfully.");

        } catch (\Exception $e) {
            return redirect()->route('auction.index')->with('error', "Something went wrong.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $auction = Auction::find($id);
            return view('backend.pages.site.auction.show', compact('auction'));
        } catch (\Exception $th) {
            return redirect()->route('auction.index')->with('error', "Something went wrong.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $auction = Auction::find($id);
            return view('backend.pages.site.auction.edit', compact('auction'));
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'price' => 'required|string|max:100',
            'days' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description1' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description2' => 'required|string',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
        ]);

        try {
            $auction = Auction::findOrFail($id);
            $auction->title = $request->title;
            $auction->price = $request->price;
            $auction->days = $request->days;
            $auction->description1 = $request->description1;
            $auction->description2 = $request->description2;
            $auction->status = $request->status ?? 'active';

            // Handle image update and deletion
            if ($request->hasFile('image')) {
                $this->deleteImage($auction->image);
                $auction->image = $this->uploadImage($request->file('image'));
            }

            if ($request->hasFile('image1')) {
                $this->deleteImage($auction->image1);
                $auction->image1 = $this->uploadImage($request->file('image1'));
            }

            if ($request->hasFile('image2')) {
                $this->deleteImage($auction->image2);
                $auction->image2 = $this->uploadImage($request->file('image2'));
            }

            $auction->save();
            return redirect()->route('auction.index')->with('success', "Auction updated successfully.");
        } catch (\Exception $e) {
            return redirect()->route('auction.index')->with('error', "Something went wrong.");
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $auction = Auction::findOrFail($id);

            if ($auction->image) {
                $imagePath = 'public/auctionSection/' . $auction->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            if ($auction->image1) {
                $imagePath = 'public/auctionSection/' . $auction->image1;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            if ($auction->image2) {
                $imagePath = 'public/auctionSection/' . $auction->image2;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $auction->delete();

            return response()->json([
                'success' => true,
                'message' => 'Featured Destination deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
    private function uploadImage($image)
    {
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'auctionSection';

            if (!Storage::exists('public/' . $destinationPath)) {
                Storage::makeDirectory('public/' . $destinationPath);
            }

            $image->storeAs($destinationPath, $imageName, 'public');
            return $imageName;
        }
        return null;
    }
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::exists('public/auctionSection/' . $imagePath)) {
            Storage::delete('public/auctionSection/' . $imagePath);
        }
    }
    public function changeStatus(string $id)
    {
        try {
            $auction = Auction::findOrFail($id);
            $auction->status = $auction->status == 'active' ? 'inactive' : 'active';
            $auction->save();

            return response()->json([
                'success' => true,
                'message' => 'Auction status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change Auction status!'
            ]);
        }
    }
}

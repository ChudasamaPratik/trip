<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TipsTravel;
use App\Models\TipsTravelsComment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TipsAndTravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = TipsTravel::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('tips-and-travels.show', $row->id) . '">
                                                <i class="dw dw-eye"></i> Show
                                            </a>
                                            <a class="dropdown-item" href="' . route('tips-and-travels.edit', $row->id) . '">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>
                                            <a class="dropdown-item delete" href="' . route('tips-and-travels.destroy', $row->id) . '">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($tipsTravel) {
                        return '<img src="' . ($tipsTravel->thumbnail_url) . '" alt="' . $tipsTravel->place_name . '" width="150" class="img">';
                    })
                    ->addColumn('status_switch', function ($tipsTravel) {
                        $checked = $tipsTravel->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $tipsTravel->id . '" data-href="' . route('tips-and-travels.change.status', $tipsTravel->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $tipsTravel->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.tips-travels.index');
        } catch (Exception $e) {
            return redirect()->route('tips-and-travels.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.pages.site.tips-travels.create');
        } catch (Exception $e) {
            return redirect()->route('tips-and-travels.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'place_name' => 'required|string|min:3|max:100',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'description1' => 'required|string',
            'image1' => 'required|image|mimes:jpg,jpeg,png',
            'description2' => 'required|string',
            'image2' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        try {
            $tipsTravel = new TipsTravel();
            $tipsTravel->id = Str::uuid();
            $tipsTravel->place_name = $request->place_name;
            $tipsTravel->description1 = $request->description1;
            $tipsTravel->description2 = $request->description2;
            $destinationPath = 'tips-and-travels';

            if (!Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailExtension = $thumbnail->getClientOriginalExtension();
                $thumbnailName = 'thumbnail_' . time() . '.' . $thumbnailExtension;

                $thumbnail->storeAs($destinationPath, $thumbnailName, 'public');
                $tipsTravel->image = $thumbnailName;
            }

            if ($request->hasFile('image1')) {
                $image1 = $request->file('image1');
                $image1Extension = $image1->getClientOriginalExtension();
                $image1Name = 'image1_' . time() . '.' . $image1Extension;

                $image1->storeAs($destinationPath, $image1Name, 'public');
                $tipsTravel->image1 = $image1Name;
            }

            if ($request->hasFile('image2')) {
                $image2 = $request->file('image2');
                $image2Extension = $image2->getClientOriginalExtension();
                $image2Name = 'image2_' . time() . '.' . $image2Extension;

                $image2->storeAs($destinationPath, $image2Name, 'public');
                $tipsTravel->image2 = $image2Name;
            }

            $tipsTravel->save();

            return redirect()->route('tips-and-travels.index')
                ->with('success', 'Tips & Travels created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating Tips & Travels: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $tipsTravel = TipsTravel::findOrFail($id);
            return view('backend.pages.site.tips-travels.show', compact('tipsTravel'));
        } catch (Exception $e) {
            return redirect()->route('tips-and-travels.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $tipsTravel = TipsTravel::findOrFail($id);
            return view('backend.pages.site.tips-travels.edit', compact('tipsTravel'));
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
            'place_name' => 'required|string|min:3|max:100',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'description1' => 'required|string',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png',
            'description2' => 'required|string',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        try {
            $tipsTravel = TipsTravel::findOrFail($id);
            $tipsTravel->place_name = $request->place_name;
            $tipsTravel->description1 = $request->description1;
            $tipsTravel->description2 = $request->description2;
            $destinationPath = 'tips-and-travels';

            if (!Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            if ($request->hasFile('thumbnail')) {
                if ($tipsTravel->image && Storage::disk('public')->exists($destinationPath . '/' . $tipsTravel->image)) {
                    Storage::disk('public')->delete($destinationPath . '/' . $tipsTravel->image);
                }

                $thumbnail = $request->file('thumbnail');
                $thumbnailExtension = $thumbnail->getClientOriginalExtension();
                $thumbnailName = 'thumbnail_' . time() . '.' . $thumbnailExtension;

                $thumbnail->storeAs($destinationPath, $thumbnailName, 'public');
                $tipsTravel->image = $thumbnailName;
            }

            if ($request->hasFile('image1')) {
                if ($tipsTravel->image1 && Storage::disk('public')->exists($destinationPath . '/' . $tipsTravel->image1)) {
                    Storage::disk('public')->delete($destinationPath . '/' . $tipsTravel->image1);
                }

                $image1 = $request->file('image1');
                $image1Extension = $image1->getClientOriginalExtension();
                $image1Name = 'image1_' . time() . '.' . $image1Extension;

                $image1->storeAs($destinationPath, $image1Name, 'public');
                $tipsTravel->image1 = $image1Name;
            }

            if ($request->hasFile('image2')) {
                if ($tipsTravel->image2 && Storage::disk('public')->exists($destinationPath . '/' . $tipsTravel->image2)) {
                    Storage::disk('public')->delete($destinationPath . '/' . $tipsTravel->image2);
                }

                $image2 = $request->file('image2');
                $image2Extension = $image2->getClientOriginalExtension();
                $image2Name = 'image2_' . time() . '.' . $image2Extension;

                $image2->storeAs($destinationPath, $image2Name, 'public');
                $tipsTravel->image2 = $image2Name;
            }

            // Save the updated record
            $tipsTravel->save();

            return redirect()->route('tips-and-travels.index')
                ->with('success', 'Tips & Travels updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating Tips & Travels: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tipsTravel = TipsTravel::findOrFail($id);

            if ($tipsTravel->image) {
                $imagePath = 'public/tips-and-travels/' . $tipsTravel->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            if ($tipsTravel->image1) {
                $imagePath = 'public/tips-and-travels/' . $tipsTravel->image1;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
            if ($tipsTravel->image2) {
                $imagePath = 'public/tips-and-travels/' . $tipsTravel->image2;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $tipsTravel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tips & Travels deleted successfully',
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
            $tipsTravel = TipsTravel::findOrFail($id);
            $tipsTravel->status = $tipsTravel->status == 'active' ? 'inactive' : 'active';
            $tipsTravel->save();

            return response()->json([
                'success' => true,
                'message' => 'Tips & Travels status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change Tips & Travels status!'
            ]);
        }
    }
    public function comments(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = TipsTravelsComment::with('tipsTravel:id,place_name')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item delete" href="' . route('tips-and-travels.destroy', $row->id) . '">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->editColumn('date', function ($faq) {
                        return Carbon::parse($faq->created_at)->format('d F, Y');
                    })
                    ->editColumn('message', function ($row) {
                        if (!empty($row->message)) {
                            $truncatedMessage = Str::limit($row->message, 30);
                            $fullMessage = htmlspecialchars($row->message, ENT_QUOTES);
    
                            if (strlen($row->message) > 30) {
                                return "<span class='truncated-message' data-full='{$fullMessage}'>{$truncatedMessage} <a href='#' class='read-more-link'>Read More</a></span>";
                            }
    
                            return $truncatedMessage;
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('place_name', function ($faq) {
                        return $faq->tipsTravel->place_name;
                    })
                    ->rawColumns(['action','message'])
                    ->make(true);
            }
            return view('backend.pages.site.tips-travels.comments');
        } catch (Exception $e) {
            return redirect()->route('tips-and-travels.index')->with('error', 'Something went wrong');
        }
    }
}

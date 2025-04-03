<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $teamMembers = Team::get();
                return DataTables::of($teamMembers)
                    ->addIndexColumn()
                    ->addColumn('action', function ($teamMember) {
                        $actions = '<div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="' . route('team.edit', $teamMember->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" href="' . route('team.destroy', $teamMember->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>';
                        return $actions;
                    })
                    ->editColumn('date', function ($teamMember) {
                        return Carbon::parse($teamMember->created_at)->format('d F, Y');
                    })
                    ->addColumn('image', function ($teamMember) {
                        return '<img src="' . ($teamMember->image_url) . '" alt="' . $teamMember->first_name . ' ' . $teamMember->last_name . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('full_name', function ($teamMember) {
                        return $teamMember->first_name . ' ' . $teamMember->last_name;
                    })
                    ->addColumn('status_switch', function ($teamMember) {
                        $checked = $teamMember->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $teamMember->id . '" data-href="' . route('team.change.status', $teamMember->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $teamMember->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.team.index');
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
            return view('backend.pages.site.team.create');
        } catch (Exception $e) {
            return redirect()->route('team.index')->with('error', 'Something went wrong');
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
            'designation' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $teamMember = new Team();
            $teamMember->id = Str::uuid();
            $teamMember->first_name = $request->first_name;
            $teamMember->last_name = $request->last_name;
            $teamMember->designation = $request->designation;
            $teamImagePath = 'team';

            if (!Storage::disk('public')->exists($teamImagePath)) {
                Storage::disk('public')->makeDirectory($teamImagePath);
            }

            if ($request->hasFile('image')) {
                $teamImage = $request->file('image');
                $teamImageExtension = $teamImage->getClientOriginalExtension();
                $teamImageName = 'team_' . time() . '.' . $teamImageExtension;

                $teamImage->storeAs($teamImagePath, $teamImageName, 'public');
                $teamMember->image = $teamImageName;
            }

            $teamMember->status = 'active'; // Default status is active
            $teamMember->save();

            return redirect()->route('team.index')
                ->with('success', 'Team member added successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error adding team member: ' . $e->getMessage())
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
            $teamMember = Team::findOrFail($id);
            return view('backend.pages.site.team.edit', compact('teamMember'));
        } catch (Exception $e) {
            return redirect()->route('team.index')->with('error', 'Something went wrong');
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
            'designation' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $teamMember = Team::findOrFail($id);
            $teamMember->first_name = $request->first_name;
            $teamMember->last_name = $request->last_name;
            $teamMember->designation = $request->designation;

            $teamImagePath = 'team';

            if (!Storage::disk('public')->exists($teamImagePath)) {
                Storage::disk('public')->makeDirectory($teamImagePath);
            }

            if ($request->hasFile('image')) {
                if ($teamMember->image && Storage::disk('public')->exists($teamImagePath . '/' . $teamMember->image)) {
                    Storage::disk('public')->delete($teamImagePath . '/' . $teamMember->image);
                }

                $teamImage = $request->file('image');
                $teamImageExtension = $teamImage->getClientOriginalExtension();
                $teamImageName = 'team_' . time() . '.' . $teamImageExtension;

                $teamImage->storeAs($teamImagePath, $teamImageName, 'public');
                $teamMember->image = $teamImageName;
            }

            $teamMember->save();

            return redirect()->route('team.index')
                ->with('success', 'Team member updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating team member: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teamMember = Team::findOrFail($id);

            if ($teamMember->image) {
                $teamImagePath = 'public/team/' . $teamMember->image;
                if (Storage::exists($teamImagePath)) {
                    Storage::delete($teamImagePath);
                }
            }

            $teamMember->delete();

            return response()->json([
                'success' => true,
                'message' => 'Team member deleted successfully',
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
            $teamMember = Team::findOrFail($id);
            $teamMember->status = $teamMember->status == 'active' ? 'inactive' : 'active';
            $teamMember->save();

            return response()->json([
                'success' => true,
                'message' => 'Team member status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change team member status!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserRequirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $testimonials = UserRequirement::where('user_id', Auth::id())->get();
                return DataTables::of($testimonials)
                    ->addIndexColumn()
                    ->addColumn('action', function ($testimonial) {
                        $actions = '<div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="' . route('requirement.edit', $testimonial->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item btn-delete" href="javascript:void(0);" data-id="' . $testimonial->id . '"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($testimonial) {
                        return '<img src="' . ($testimonial->image_url) . '" alt="' . $testimonial->destination . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
            }
            return view('backend.pages.requirement.index');
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
            return view('backend.pages.requirement.create');
        } catch (Exception $e) {
            return redirect()->route('requirement.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'origin' => 'required|string|min:2|max:100',
            'destination' => 'required|string|min:2|max:100',
            'days' => 'required|numeric|min:1',
            'persons' => 'required|numeric|min:1',
            'accommodation_type' => 'required|string|min:2|max:100',
            'breakfast' => 'required|string',
            'price' => 'required|numeric|min:0',
            'tour' => 'required|string|min:2|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $requirement = new UserRequirement();
            $requirement->id = Str::uuid();
            $requirement->user_id = Auth::id();
            $requirement->origin = $request->origin;
            $requirement->destination = $request->destination;
            $requirement->days = $request->days;
            $requirement->person = $request->persons;
            $requirement->accommodation = $request->accommodation_type;
            $requirement->breakfast = $request->breakfast;
            $requirement->price = $request->price;
            $requirement->tour = $request->tour;
            $requirementImagePath = 'requirements';

            if (!Storage::disk('public')->exists($requirementImagePath)) {
                Storage::disk('public')->makeDirectory($requirementImagePath);
            }

            if ($request->hasFile('image')) {
                $requirementImage = $request->file('image');
                $requirementImageExtension = $requirementImage->getClientOriginalExtension();
                $requirementImageName = 'requirement_' . time() . '.' . $requirementImageExtension;

                $requirementImage->storeAs($requirementImagePath, $requirementImageName, 'public');
                $requirement->image = $requirementImageName;
            }

            $requirement->save();

            return redirect()->route('requirement.index')
                ->with('success', 'Requirement submitted successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error submitting requirement: ' . $e->getMessage())
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
            $requirement = UserRequirement::findOrFail($id);
            return view('backend.pages.requirement.edit', compact('requirement'));
        } catch (Exception $e) {
            return redirect()->route('requirement.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'origin' => 'required|string|min:2|max:100',
            'destination' => 'required|string|min:2|max:100',
            'days' => 'required|numeric|min:1',
            'persons' => 'required|numeric|min:1',
            'accommodation_type' => 'required|string|min:2|max:100',
            'breakfast' => 'required|string',
            'price' => 'required|numeric|min:0',
            'tour' => 'required|string|min:2|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        try {
            $requirement = UserRequirement::findOrFail($id);
            $requirement->origin = $request->origin;
            $requirement->destination = $request->destination;
            $requirement->days = $request->days;
            $requirement->person = $request->persons;
            $requirement->accommodation = $request->accommodation_type;
            $requirement->breakfast = $request->breakfast;
            $requirement->price = $request->price;
            $requirement->tour = $request->tour;

            $requirementImagePath = 'requirements';

            if (!Storage::disk('public')->exists($requirementImagePath)) {
                Storage::disk('public')->makeDirectory($requirementImagePath);
            }

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($requirement->image) {
                    $oldImagePath = $requirementImagePath . '/' . $requirement->image;
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                $requirementImage = $request->file('image');
                $requirementImageExtension = $requirementImage->getClientOriginalExtension();
                $requirementImageName = 'requirement_' . time() . '.' . $requirementImageExtension;

                $requirementImage->storeAs($requirementImagePath, $requirementImageName, 'public');
                $requirement->image = $requirementImageName;
            }

            $requirement->save();

            return redirect()->route('requirement.index')
                ->with('success', 'Requirement updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating requirement: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

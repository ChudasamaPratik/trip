<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = ContactContent::all();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return '
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="' . route('contact.edit', $row->id) . '">
                                    <i class="dw dw-edit2"></i> Edit
                                </a>
                                <a class="dropdown-item delete" href="' . route('contact.destroy', $row->id) . '">
                                    <i class="dw dw-delete-3"></i> Delete
                                </a>
                            </div>
                        </div>';
                    })
                    ->editColumn('description', function ($contact) {
                        return Str::limit(strip_tags($contact->description), 50);
                    })
                    ->addColumn('status_switch', function ($contact) {
                        $checked = $contact->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $contact->id . '" data-href="' . route('contact.change.status', $contact->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $contact->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.contact.index');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.site.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'phone' => 'required|string|max:10',
            'address' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3',
        ], [
            'email' => 'Please e-Mail is required.',
            'phone' => 'Please phone is required.',
            'phone.max' => 'Please phone is Cannot exceed 10 digit.',
            'address' => "Please address is required.",
            'address.max' => "must be at Max 50 characters long..",
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 3 characters long.',
        ]);
        try {
            $contact = new ContactContent();
            $contact->id = Str::uuid();
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->address = $request->address;
            $contact->description = $request->description;
            $contact->save();
            return redirect()->route('contact.index')->with('success', 'Contact us created successfully');
        } catch (\Exception $e) {
            return redirect()->route('contact.create')->with('error', 'Something Wrong.');
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
            $contact = ContactContent::findOrFail($id);
            return view('backend.pages.site.contact.edit', compact('contact'));
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|string',
            'phone' => 'required|string|max:10',
            'address' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3',
        ], [
            'email' => 'Please e-Mail is required.',
            'phone' => 'Please phone is required.',
            'phone.max' => 'Please phone is Cannot exceed 10 digit.',
            'address' => "Please address is required.",
            'address.max' => "must be at Max 50 characters long..",
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 3 characters long.',
        ]);
        try {
            $contact = ContactContent::findOrFail($id);
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->address = $request->address;
            $contact->description = $request->description;
            $contact->save();
            return redirect()->route('contact.index')->with('success', 'Contact us Update successfully');
        } catch (\Exception $e) {
            return redirect()->route('contact.create')->with('error', 'Something Wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $How = ContactContent::findOrFail($id);
            $How->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contact Content deleted successfully',
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
            $How = ContactContent::findOrFail($id);
            $How->status = $How->status == 'active' ? 'inactive' : 'active';
            $How->save();

            return response()->json([
                'success' => true,
                'message' => 'Contact Content status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change About status!'
            ]);
        }
    }
}

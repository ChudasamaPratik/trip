<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Footer::get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actions = '<div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="' . route('footer.edit', $row->id) . '"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item delete" href="' . route('footer.destroy', $row->id) . '" ><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>';
                        return $actions;
                    })
                    ->addColumn('status_switch', function ($footer) {
                        $checked = $footer->status == 'active' ? 'checked' : '';
                        return '
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $footer->id . '" data-href="' . route('footer.change.status', $footer->id) . '" ' . $checked . '>
                            <label class="custom-control-label" for="statusToggle' . $footer->id . '"></label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.site.footer.index');
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Something went wrong');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.site.footer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'facebook_link' => 'nullable|string|min:3|max:100',
            'twitter_link' => 'nullable|string|min:3|max:100',
            'instagram_link' => 'nullable|string|min:3|max:100',
            'linkedin_link' => 'nullable|string|min:3|max:100',
            'youtube_link' => 'nullable|string|min:3|max:100',
            'whatsapp_link' => 'nullable|string|min:3|max:100',
            'description' => 'required|string|min:3',
            'declaimer_description' => 'required|string|min:3',
            'tc_description' => 'required|string|min:3',
        ], [
            'facebook_link.min' => 'Facebook link must be at least 3 characters long.',
            'facebook_link.max' => 'Facebook link cannot exceed 100 characters.',
            'twitter_link.min' => 'Twitter link must be at least 3 characters long.',
            'twitter_link.max' => 'Twitter link cannot exceed 100 characters.',
            'instagram_link.min' => 'Instagram link must be at least 3 characters long.',
            'instagram_link.max' => 'Instagram link cannot exceed 100 characters.',
            'linkedin_link.min' => 'LinkedIn link must be at least 3 characters long.',
            'linkedin_link.max' => 'LinkedIn link cannot exceed 100 characters.',
            'youtube_link.min' => 'YouTube link must be at least 3 characters long.',
            'youtube_link.max' => 'YouTube link cannot exceed 100 characters.',
            'whatsapp_link.min' => 'WhatsApp link must be at least 3 characters long.',
            'whatsapp_link.max' => 'WhatsApp link cannot exceed 100 characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 3 characters long.',
            'declaimer_description.required' => 'Declaimer description is required.',
            'declaimer_description.min' => 'Declaimer description must be at least 3 characters long.',
            'tc_description.required' => 'Terms & Conditions description is required.',
            'tc_description.min' => 'Terms & Conditions description must be at least 3 characters long.',
        ]);
        try {
            $footer = new Footer();
            $footer->id = Str::uuid();
            $footer->facebook_link = $request->facebook_link;
            $footer->twitter_link = $request->twitter_link;
            $footer->instagram_link = $request->instagram_link;
            $footer->linkedin_link = $request->linkedin_link;
            $footer->youtube_link = $request->youtube_link;
            $footer->whatsapp_link = $request->whatsapp_link;
            $footer->description = $request->description;
            $footer->declaimer_description = $request->declaimer_description;
            $footer->tc_description = $request->tc_description;
            $footer->save();
            return redirect()->route('footer.index')->with('success', 'Footer created successfully');
        } catch (\Exception $th) {
            return redirect()->route('footer.create')->with('error', 'Something Wrong.');
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
            $footer = Footer::find($id);
            return view('backend.pages.site.footer.edit', compact('footer'));
        } catch (\Exception $e) {
            return redirect()->route('how-does-it-work.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'facebook_link' => 'nullable|string|min:3|max:100',
            'twitter_link' => 'nullable|string|min:3|max:100',
            'instagram_link' => 'nullable|string|min:3|max:100',
            'linkedin_link' => 'nullable|string|min:3|max:100',
            'youtube_link' => 'nullable|string|min:3|max:100',
            'whatsapp_link' => 'nullable|string|min:3|max:100',
            'description' => 'required|string|min:3',
            'declaimer_description' => 'required|string|min:3',
            'tc_description' => 'required|string|min:3',
        ], [
            'facebook_link.min' => 'Facebook link must be at least 3 characters long.',
            'facebook_link.max' => 'Facebook link cannot exceed 100 characters.',
            'twitter_link.min' => 'Twitter link must be at least 3 characters long.',
            'twitter_link.max' => 'Twitter link cannot exceed 100 characters.',
            'instagram_link.min' => 'Instagram link must be at least 3 characters long.',
            'instagram_link.max' => 'Instagram link cannot exceed 100 characters.',
            'linkedin_link.min' => 'LinkedIn link must be at least 3 characters long.',
            'linkedin_link.max' => 'LinkedIn link cannot exceed 100 characters.',
            'youtube_link.min' => 'YouTube link must be at least 3 characters long.',
            'youtube_link.max' => 'YouTube link cannot exceed 100 characters.',
            'whatsapp_link.min' => 'WhatsApp link must be at least 3 characters long.',
            'whatsapp_link.max' => 'WhatsApp link cannot exceed 100 characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 3 characters long.',
            'declaimer_description.required' => 'Declaimer description is required.',
            'declaimer_description.min' => 'Declaimer description must be at least 3 characters long.',
            'tc_description.required' => 'Terms & Conditions description is required.',
            'tc_description.min' => 'Terms & Conditions description must be at least 3 characters long.',
        ]);
        try {
            $footer = Footer::findOrFail($id);
            $footer->facebook_link = $request->facebook_link;
            $footer->twitter_link = $request->twitter_link;
            $footer->instagram_link = $request->instagram_link;
            $footer->linkedin_link = $request->linkedin_link;
            $footer->youtube_link = $request->youtube_link;
            $footer->whatsapp_link = $request->whatsapp_link;
            $footer->description = $request->description;
            $footer->declaimer_description = $request->declaimer_description;
            $footer->tc_description = $request->tc_description;
            $footer->update();
            return redirect()->route('footer.index')->with('success', 'Footer Content Update successfully');
        } catch (\Exception $th) {
            return redirect()->route('footer.create')->with('error', 'Something Wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $How = Footer::findOrFail($id);
            $How->delete();

            return response()->json([
                'success' => true,
                'message' => 'Footer Content deleted successfully',
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
            $How = Footer::findOrFail($id);
            $How->status = $How->status == 'active' ? 'inactive' : 'active';
            $How->save();

            return response()->json([
                'success' => true,
                'message' => 'Footer Content status changed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change About status!'
            ]);
        }
    }
}

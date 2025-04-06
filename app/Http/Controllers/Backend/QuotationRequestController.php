<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class QuotationRequestController extends Controller
{
    public function quotationRequestIndex(Request $request)
    {
        try {
            if ($request->ajax()) {
                $testimonials = Quotation::with('requirement')->where('agent_id', Auth::id())->latest()->get();
                return DataTables::of($testimonials)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        if ($row->price && $row->description && $row->attachment) {
                            $actionBtn = '<a href="' . route('quotation.request.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Show</a>';
                        } else {
                            $actionBtn = '<a href="' . route('quotation.request.create', $row->id) . '" class="btn btn-primary btn-sm quotation-btn"><i class="fa fa-file-text"></i> Quotation</a>';
                        }

                        return $actionBtn;
                    })
                    ->addColumn('image', function ($testimonial) {
                        return '<img src="' . ($testimonial->requirement->image_url) . '" alt="' . $testimonial->destination . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('days_persons', function ($testimonial) {
                        return $testimonial->requirement->days . ' Days / ' . $testimonial->requirement->person . ' Persons';
                    })
                    ->rawColumns(['image', 'action', 'days_persons'])
                    ->make(true);
            }
            return view('backend.pages.quotation-request.index');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    public function createQuotation($id)
    {
        try {
            $quotation = Quotation::with('requirement')->findOrFail($id);

            return view('backend.pages.quotation-request.create', compact('quotation'));
        } catch (Exception $e) {
            return redirect()->route('quotation.request.index')->with('error', 'Quotation not found');
        }
    }


    public function storeQuotation(Request $request, $id)
    {
        try {
            $quotation = Quotation::with('requirement')->findOrFail($id);
            $existingQuotation = Quotation::where('requirement_id', $quotation->requirement_id)
                ->where('agent_id', $quotation->agent_id)

                ->where(function ($query) {
                    $query->whereNotNull('price')
                        ->whereNotNull('description')
                        ->whereNotNull('attachment');
                })
                ->first();

            if ($existingQuotation) {
                return redirect()->route('quotation.request.index')->with('error', 'A quotation for this requirement has already been submitted by you.');
            }
            // Validate the request
            $request->validate([
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'attachment' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            ]);

            // Update quotation details
            $quotation->price = $request->price;
            $quotation->description = $request->description;

            // Handle file upload
            $destinationPath = 'quotations';

            if (!Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachmentExtension = $attachment->getClientOriginalExtension();
                $attachmentName = 'quotation_' . time() . '.' . $attachmentExtension;

                $attachment->storeAs($destinationPath, $attachmentName, 'public');
                $quotation->attachment = $attachmentName;
            }

            // Update status
            $quotation->status = 'pending';
            $quotation->save();

            // Also update the requirement status to quoted
            $requirement = $quotation->requirement;
            $requirement->status = 'quoted';
            $requirement->save();

            return redirect()->route('quotation.request.index')->with('success', 'Quotation submitted successfully');
        } catch (Exception $e) {
            return redirect()->route('quotation.request.index')->with('error', 'Failed to submit quotation: ' . $e->getMessage());
        }
    }

    public function showQuotation($id)
    {
        try {
            $quotation = Quotation::with('requirement')->findOrFail($id);
            return view('backend.pages.quotation-request.show', compact('quotation'));
        } catch (Exception $e) {
            return redirect()->route('quotation.request.index')->with('error', 'Quotation not found');
        }
    }
}

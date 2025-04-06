<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\User;
use App\Models\UserRequirement;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class UserRequirementsController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $testimonials = UserRequirement::get();
                return DataTables::of($testimonials)
                    ->addIndexColumn()
                    ->addColumn('action', function ($testimonial) {
                        $quoteButton = '';
                        $viewQuotationsButton = '';

                        // Only show Request Quote button if not already quoted/confirmed/assigned
                        if (!in_array($testimonial->status, ['quoted', 'confirmed', 'assigned'])) {
                            $quoteButton = '<a class="dropdown-item btn-assign-agent" href="javascript:void(0);" data-id="' . $testimonial->id . '"><i class="dw dw-share"></i> Request Quote</a>';
                        }

                        // Show View Quotations button if there are any quotations
                        $quotationsCount = Quotation::where('requirement_id', $testimonial->id)->count();
                        if ($quotationsCount > 0) {
                            $viewQuotationsButton = '<a class="dropdown-item" href="' . route('requirements.quotations', $testimonial->id) . '"><i class="dw dw-file-31"></i> View Quotations (' . $quotationsCount . ')</a>';
                        }

                        $actions = '<div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        ' . $quoteButton . '
                                        ' . $viewQuotationsButton . '
                                        <a class="dropdown-item btn-delete" href="javascript:void(0);" data-id="' . $testimonial->id . '"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($testimonial) {
                        return '<img src="' . ($testimonial->image_url) . '" alt="' . $testimonial->destination . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('quotations_count', function ($testimonial) {
                        // Count quotations for this requirement
                        $count = Quotation::where('requirement_id', $testimonial->id)->count();
                        $badge = '<span class="badge badge-pill badge-' . ($count > 0 ? 'success' : 'secondary') . '">' . $count . '</span>';
                        return $badge;
                    })
                    ->rawColumns(['image', 'action', 'quotations_count'])
                    ->make(true);
            }
            $agents = User::role('agent')->get();
            return view('backend.pages.user-requirements.index', compact('agents'));
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    public function requirementQuotations($id)
    {
        try {
            $requirement = UserRequirement::findOrFail($id);
            $quotations = Quotation::with('agent')->where('requirement_id', $id)->get();

            return view('backend.pages.user-requirements.quotations', compact('requirement', 'quotations'));
        } catch (Exception $e) {
            return redirect()->route('requirements.quotations')->with('error', 'Requirement not found');
        }
    }

    public function assignAgents(Request $request)
    {
        try {
            $request->validate([
                'requirement_id' => 'required|exists:user_requirements,id',
                'assignment_type' => 'required|in:public,agent',
                'agent_ids' => 'required_if:assignment_type,agent|array',
                'agent_ids.*' => 'exists:users,id',
                'send_email' => 'nullable',
                'response_deadline' => 'nullable|date|after:now',
            ]);

            $requirement = UserRequirement::findOrFail($request->requirement_id);
            $deadline = null;
            if ($request->filled('response_deadline')) {
                $deadline = $request->response_deadline;
            }
            if ($request->assignment_type == 'public') {

                $requirement->update([
                    'status' => 'public',
                    'response_deadline' => $deadline
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Quotation request made available to all agents successfully'
                ]);
            } else {

                $requirement->update([
                    'status' => 'assigned',
                    'response_deadline' => $deadline
                ]);

                // Create empty "invitation" quotations for each selected agent
                foreach ($request->agent_ids as $agentId) {
                    Quotation::create([
                        'id' => Str::uuid(),
                        'requirement_id' => $requirement->id,
                        'agent_id' => $agentId,
                    ]);

                    // Send email notification if checked
                    // if ($request->has('send_email')) {
                    //     $agent = Agent::find($agentId);
                    //     if ($agent && $agent->email) {
                    //         Mail::to($agent->email)->send(new QuotationRequestMail($requirement, $agent));
                    //     }
                    // }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Quotation request sent to selected agents successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

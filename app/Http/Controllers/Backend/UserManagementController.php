<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    public function userIndex(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = User::role('user')->get();

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        $actions = '<div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item show" href="' . route('user-management.view.profile', $user->id) . '" ><i class="dw dw-eye"></i> Show</a>
                        </div>
                            </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($user) {
                        return '<img src="' . ($user->image_url) . '" alt="' . $user->first_name . ' ' . $user->last_name . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('status_switch', function ($user) {
                        $checked = $user->status == 'active' ? 'checked' : '';
                        return '
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $user->id . '" data-href="' . route('user-management.change.status', $user->id) . '" ' . $checked . '>
                    <label class="custom-control-label" for="statusToggle' . $user->id . '"></label>
                </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.user-manage.index-users');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    public function agentIndex(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = User::role('agent')->get();

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        $actions = '<div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item show" href="' . route('user-management.view.profile', $user->id) . '" ><i class="dw dw-eye"></i> Show</a>
                        </div>
                            </div>';
                        return $actions;
                    })
                    ->addColumn('image', function ($user) {
                        return '<img src="' . ($user->image_url) . '" alt="' . $user->first_name . ' ' . $user->last_name . '" width="80" height="80" class="img img-thumbnail">';
                    })
                    ->addColumn('status_switch', function ($user) {
                        $checked = $user->status == 'active' ? 'checked' : '';
                        return '
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input change-status" id="statusToggle' . $user->id . '" data-href="' . route('user-management.change.status', $user->id) . '" ' . $checked . '>
                    <label class="custom-control-label" for="statusToggle' . $user->id . '"></label>
                </div>';
                    })
                    ->rawColumns(['image', 'action', 'status_switch'])
                    ->make(true);
            }
            return view('backend.pages.user-manage.index-agents');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Something went wrong');
        }
    }

    public function changeStatus(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = $user->status == 'active' ? 'inactive' : 'active';
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User status changed successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change User status!'
            ]);
        }
    }

    public function viewProfile(string $id)
    {
        try {
            $user = User::with(['roles', 'userDetails', 'agentDetails'])->findOrFail($id);

            return view('backend.pages.user-manage.show-profile', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found');
        }
    }
}

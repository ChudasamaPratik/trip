<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Role::with('permissions')->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('permissions', function ($row) {
                        $permissions = $row->permissions->pluck('name')->map(function ($permission) {
                            return '<span class="badge bg-black">' . $permission . '</span>';
                        })->implode(' ');

                        return $permissions;
                    })
                    ->addColumn('action', function ($row) {
                        $permissions = $row->permissions->pluck('id')->toArray();
                        $permissionsJson = json_encode($permissions);

                        $btn = '<a href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-permissions="' . $permissionsJson . '" class="edit btn btn-warning btn-sm"><i class="bi bi-pen"></i> Edit</a>';
                        return $btn;
                    })

                    ->rawColumns(['permissions', 'action'])
                    ->make(true);
            }

            $permissions = Permission::get();
            return view('backend.pages.role.index', compact('permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'array',
        ]);
        try {
            $role = Role::create(['name' => $request->name]);

            if ($request->has('permission')) {
                $role->syncPermissions($request->permission);
            }

            return response()->json(['status' => 'success', 'message' => 'Role created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'array',
        ]);
        try {
            $role = Role::findOrFail($id);
            $role->update(['name' => $request->name]);

            if ($request->has('permission')) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }

            return response()->json(['status' => 'success', 'message' => 'Role updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
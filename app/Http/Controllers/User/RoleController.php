<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AssignPermission;
use App\Http\Requests\Role\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        return redirect()->route('backend.role.index')
                ->with('success', 'Thêm mới vai trò thành công');
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
    public function edit(Role $role)
    {
        return view('backend.roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->update();
        return redirect()->route('backend.role.index')
            ->with('success', 'Cập nhật vai trò thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('backend.role.index')->with('success', 'Xóa vai trò thành công');
    }
    public function assignPermissionView(Role $role)
    {
        $permissions = Permission::all();

        return view('backend.roles.assign-permission', compact(['role', 'permissions']));
    }
    public function assignPermission(AssignPermission $request, Role $role)
    {
        $role->syncPermissions($request->permission);
        return back()->
        with('success', 'Thêm quyền vào vai trò '. $role->name.' thành công');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get(['id', 'name']);
        $permissions = Permission::get(['id', 'name']);
        return view('role.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $role = Role::create($validate);
        return redirect()->route('role.index')->with('success', "$role->name Role Created Successfully.");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $role->update($validate);
        return redirect()->route('role.index')->with('success', "$role->name Role Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', "$role->name Role Deleted Successfully.");
    }
    public function addPermissionToRole(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        return back()->with('success', 'Permissions assigned successfully!');
    }
    public function assignRolesToUser(User $user,Request $request){
        $roles = Role::whereIn('id',$request->roles)->get();
        $user->syncRoles($roles);
        return back()->with('success','Role Assigned User Successfully.');
    }
}

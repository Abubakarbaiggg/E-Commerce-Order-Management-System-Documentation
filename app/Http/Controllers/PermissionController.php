<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
 
class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Permission view', only: ['index','show']),
            new Middleware('permission:Permission create', only: ['create','store']),
            new Middleware('permission:Permission edit', only: ['edit','update']),
            new Middleware('permission:Permission delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(5,['id','name']);
        return view('permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255','unique:permissions,name']
        ]);
        $permission = Permission::create($validate);
        return redirect()->route('permission.index')->with('success', "$permission->name Permission Created Successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $permission->update($validate);
        return redirect()->route('permission.index')->with('success', "$permission->name Permission Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permission.index')->with('success', "$permission->name Permission Deleted Successfully.");
    }

    public function assignPermissionsToUser(User $user,Request $request){
        $permissions = Permission::whereIn('id',$request->permissions)->get();
        $user->givePermissionTo($permissions);
        return back()->with('success','Permission Assigned User Successfully.');
    }
}

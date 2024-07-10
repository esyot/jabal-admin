<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
{
  
    $users = User::all();
    $roles = Role::all();
    $permissions = Permission::all();

   
    $userRoles = [];
    $userPermissions = [];

   
    foreach ($users as $user) {
        $userRoles[$user->id] = $user->roles()->get();
        $userPermissions[$user->id] = $user->permissions;
    }

    return view('manage', compact('users', 'roles', 'permissions', 'userRoles', 'userPermissions'));
}

    public function show(User $user)
    {
       
        $roles = Role::all();
        $permissions = Permission::all();

        
        $userRoles = $user->roles()->get();
        $userPermissions = $user->permissions;

        return view('manage', compact('users', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
      

     
        $user->syncRoles($request->roles);

      
        $user->syncPermissions($request->permissions);

        return redirect()->route('manage-users')
            ->with('success', 'Permissions updated successfully');
    }
}

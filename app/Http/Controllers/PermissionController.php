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
    // Fetch all users, roles, and permissions
    $users = User::all();
    $roles = Role::all();
    $permissions = Permission::all();

    // Initialize arrays to store user-specific roles and permissions
    $userRoles = [];
    $userPermissions = [];

    // Fetch roles and permissions for each user
    foreach ($users as $user) {
        $userRoles[$user->id] = $user->roles()->get();
        $userPermissions[$user->id] = $user->permissions;
    }

    return view('manage', compact('users', 'roles', 'permissions', 'userRoles', 'userPermissions'));
}

    public function show(User $user)
    {
        // Fetch all roles and permissions
        $roles = Role::all();
        $permissions = Permission::all();

        // Fetch user's current roles and permissions
        $userRoles = $user->roles()->get();
        $userPermissions = $user->permissions;

        return view('manage', compact('users', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        // Validate incoming request

        // Update roles
        $user->syncRoles($request->roles);

        // Update permissions
        $user->syncPermissions($request->permissions);

        return redirect()->route('manage-users')
            ->with('success', 'Permissions updated successfully');
    }
}

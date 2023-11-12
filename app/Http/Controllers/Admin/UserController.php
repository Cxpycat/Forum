<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Role\RoleResource;
use App\Http\Requests\User\ToggleRoleRequest;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\User\UserWithRoleResource;

class UserController extends Controller
{

    public function index ()
    {
        $users = User::all();
        $users = UserWithRoleResource::collection($users)->resolve();
        $roles = Role::all();
        $roles = RoleResource::collection($roles)->resolve();
        return inertia('Admin/User/Index', compact('users', 'roles'));
    }

    public function toggleRole (User $user, ToggleRoleRequest $request)
    {
        $data = $request->validated();

        $user->roles()->toggle($data['role_id']);

        $user->load('roles');

        return UserWithRoleResource::make($user)->resolve();
    }

}

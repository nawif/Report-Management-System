<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;


class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::paginate(15);
        $roles = Role::all();
        return view('usersList' , ['users' => $users,'roles' => $roles]);
    }
    public function updateUserRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        dd($request);
        // $user->

    }
}

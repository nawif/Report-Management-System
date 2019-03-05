<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;


class UserController extends Controller
{
    //ONLY ADMIN
    public function getUsers($alerts =null)
    {
        $users = User::paginate(15);
        $roles = Role::all();
        return view('usersList' , ['users' => $users,'roles' => $roles, 'alert' => $alert]);
    }

    //ONLY ADMIN
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = $request->input('roles');
        if($roles)
            $user->roles()->sync($roles);
        return $this->getUsers(['type'=>'success','message' => 'user '.$user->name.' updated!']);

    }
}

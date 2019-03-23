<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Group;


class UserController extends Controller
{
    //ONLY ADMIN
    public function getUsers($alert =null)
    {
        $users = User::paginate(15);
        $roles = Role::all();
        $groups = Group::all();
        return view('user.usersList' , ['users' => $users,'roles' => $roles, 'groups' => $groups, 'alert' => $alert]);
    }

    //ONLY ADMIN
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = $request->input('roles');
        if($roles)
            $user->roles()->sync($roles);
        return $this->getUsers(['type'=>'success','message' => 'User '.$user->name.' information updated!']);

    }

    public function delete($id)
    {
        $user = User::find($id)->delete();
        if($user)
            return $this->getUsers(['type'=>'success','message' => 'User information deleted!']);
        else
            return $this->getUsers(['type'=>'danger','message' => 'No user with such id']);
    }
}

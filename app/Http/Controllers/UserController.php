<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Group;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    //ONLY ADMIN
    public function index()
    {
        $alert=null;
        $alertType=Input::get('type');
        $alertMessage=Input::get('message');

        if($alertType && $alertMessage){
            $alert['type']=$alertType;
            $alert['message']=$alertMessage;

        }

        $users = User::paginate(15);
        $roles = Role::all();

        return view('user.usersList' , ['users' => $users,'roles' => $roles, 'alert' => $alert]);
    }

    //ONLY ADMIN
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = $request->input('roles');
        if($roles)
            $user->roles()->sync($roles);
        return redirect()->action(
            'UserController@index', ['type'=>'success','message' => 'User '.$user->name.' information updated!']
        );

    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->action(
                'UserController@index', ['type'=>'success','message' => 'User information deleted!']
            );
        }
        else
            return redirect()->action(
                'UserController@index', ['type'=>'danger','message' => 'No user with such id']
            );
    }
}

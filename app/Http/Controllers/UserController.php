<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
    public function update(Request $request, $id, $type)
    {
        $user = User::findOrFail($id);
        $roles = $request->input('roles');
        $groups = $request->input('groups');
        if($roles)
            $user->roles()->sync($roles);
            else
                if($type == 'roles')
                    $user->roles()->detach();
        if($groups)
            $user->groups()->sync($groups);
        return redirect()->action(
            'UserController@index', ['type'=>'success','message' => 'User '.$user->name.' information updated!']
        );

    }

    //ONLY ADMIN
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

    public function editForm()
    {
        $user = Auth::user();
        return view('auth.editUser',['user'=>$user]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|unique:users,name,'.$user->id.'|max:40',
            'password' => 'nullable|min:6|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6'
        ]);
        $user = Auth::user();
        $user->name=$request->input('name');
        if($request->input('password'))
            $user->password=Hash::make($request->input('password'));
        $user->save();
        return view('auth.editUser',['user'=>$user]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


}

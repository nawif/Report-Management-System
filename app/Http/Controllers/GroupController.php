<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alert=null;
        $alertType=Input::get('type');
        $alertMessage=Input::get('message');
        if($alertType && $alertMessage){
            $alert['type']=$alertType;
            $alert['message']=$alertMessage;

        }
        $groups = Group::paginate(15);
        return view('group.index' , ['groups' => $groups, 'alert' => $alert]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $group = Group::create(array('name' => $request->input('group_name')));
        } catch (QueryException $th) {
            return redirect()->action(
                'GroupController@index', ['type'=>'danger','message' => 'Group '.$request->input('group_name').' already exist!']
            );
        }
        return redirect()->action(
            'GroupController@index', ['type'=>'success','message' => 'Group '.$group->name.' created!']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserList($id)
    {
        $user = User::find($id);
        $groups = Group::paginate(15);

        return view('group.userGroupList', ['user' => $user, 'groups' => $groups]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $users = $request->input('users');
        $group->name = $request->input('group_name');
        try {
        $group->save();
        } catch (QueryException $th) {
            return redirect()->action(
                'GroupController@index', ['type'=>'danger','message' => 'Group '.$group->name.' information didn\'t updated!']
            );

        }
        if($users)
            $group->users()->sync($users);
        return redirect()->action(
            'GroupController@index', ['type'=>'success','message' => 'Group '.$group->name.' information updated!']
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        if($group){
            $group->delete();
           return redirect()->action(
                'GroupController@index', ['type'=>'success','message' => 'Group deleted!']
            );
        }

        else
            return redirect()->action(
                'GroupController@index', ['type'=>'danger','message' => 'No group with such id']
            );
    }
}

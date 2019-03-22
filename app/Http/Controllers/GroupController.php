<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use Symfony\Component\Console\Input\Input;
use Illuminate\Database\QueryException;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alert =null )
    {
        $groups = Group::paginate(15);
        $users = User::all();
        return view('group.index' , ['groups' => $groups, 'users' => $users, 'alert' => $alert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            return $this->index(['type'=>'danger','message' => 'Group '.$group->name.' information didn\'t updated!']);
        }
        if($users)
            $group->users()->sync($users);
        return $this->index(['type'=>'success','message' => 'Group '.$group->name.' information updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id)->delete();
        if($group)
            return $this->index(['type'=>'success','message' => 'Group information deleted!']);
        else
            return $this->index(['type'=>'danger','message' => 'No group with such id']);
    }
}

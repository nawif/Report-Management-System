<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateReport;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Group;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\ReportMultimedia;


class MigrationController extends Controller
{


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function createUser(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:users|max:40',
            'password' => 'required|min:6|max:40',
            'email' => 'required|email|unique:users|min:6|max:40'
        ]);
        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $this->createGroups($user, $request['groups']);
        return $user;
    }
    public function createReport(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required',
            'group_id' => 'required|exists:groups,id',
            'author_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()]);
        $report = Report::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'group_id' => $request['group_id'],
            'author_id' => $request['author_id'],
        ]);
        $this->createTags($report, $request['tags']);
        return $report;
    }

    public function createGroup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique',
        ]);
        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()]);
        return Group::create([
            'name' => $request['name']
        ]);

    }

    public function attachFilesToReport(Request $request, $report_id)
    {
        if(Report::find($report_id)){
            $this->storeFiles(['attachment' => $request->file('attachment')], $report_id);
            return response()->json("files stored successfully", 200);
        }else
            return response()->json("no report with such id", 200);

    }


    /*
        Helpers
    */
    public function createTags($report, $tags)
    {
        foreach ($tags as $tag) {
            if (empty(ltrim(strtolower($tag))))
                continue;
            $existingTag = Tag::where('name', '=', ltrim(strtolower($tag)))->first();
            if ($existingTag) {
                $report->tags()->attach($existingTag);
                continue;
            }
            $tagInsert['name'] = strtolower($tag);
            $tag = Tag::create($tagInsert);
            $report->tags()->attach($tag);
        }
    }

    public function createGroups($user, $groups)
    {
        foreach ($groups as $group) {
            if (empty(ltrim(strtolower($group))))
                continue;
            $existingGroup = Group::where('name', '=', ltrim(strtolower($group)))->first();
            if ($existingGroup) {
                $user->groups()->attach($existingGroup);
                continue;
            }
            $groupInsert['name'] = strtolower($group);
            $group = Group::create($groupInsert);
            $user->groups()->attach($group);
        }
    }

    public function storeFiles($request, $reportID){
        $path="public/reportAttachments/";
        if(!$request['attachment']){
            return;
        }
        foreach ($request['attachment'] as $file) {
            $path=$path.uniqid().".".$file->getClientOriginalExtension();
            Storage::put($path, file_get_contents($file));
            $multimedia['report_id']=$reportID;
            $multimedia['title']=$file->getClientOriginalName();
            $multimedia['path']=$path;
            ReportMultimedia::create($multimedia);
        }
    }
}

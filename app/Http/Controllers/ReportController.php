<?php

namespace App\Http\Controllers;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\ReportMultimedia;
use App\User;
use App\Http\Resources\Report as ReportResource;
use App\Http\Requests\CreateReport;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    /*
        Routes Method
    */
    public function getReport($id){
        $report= Report::find($id);
        return view('report.reportPage',['reports'=> $report]);
    }

    public function getCreateReportPage(){
        $groups=Auth::user()->groups()->get();
        return view('report.createReport',['groups' => $groups]);
    }

    public function createReport(CreateReport $request){
        $request->validated();
        $data=$this->extractFormData($request);
        $report= Report::create($data);
        $this->createTags($data, $report);
        $this->storeFiles($request, $report->id);
        return redirect()->action(
            'ReportController@getReportList', ['type'=>'success','message' => 'report  created successfully']
        );

    }

    public function getReportList($alert = null){
        $reportData = $this->getAuthorizedArticles();
        $alertType=Input::get('type');
        $alertMessage=Input::get('message');

        if($alertType && $alertMessage){
            $alert['type']=$alertType;
            $alert['message']=$alertMessage;
        }
        return view('report.reportList', ['reports' => $reportData , 'alert' => $alert]);

    }

    public function getAuthorReportList($author_name){
        $author_name = str_replace('-',' ',$author_name);
        $reports = $this->getReportsByAuthor($author_name);
        if($reports)
            return view('report.reportList', ['reports' => $reports]);
        else
        return redirect()->action(
            'ReportController@getReportList', ['type'=>'danger','message' => 'there are no results that match your search']
        );
    }

    public function search(Request $request)
    {
        $searchBy = $request->get('searchBy');
        $searchVal = $request->get('searchVal');
        $queryResult = $this->querySearch($searchBy, $searchVal);
        if(!$queryResult)
        return redirect()->action(
            'ReportController@getReportList', ['type'=>'danger','message' => 'there are no results that match your search']
        );
        if(in_array($searchBy,['content', 'title'])){
            $reports = $queryResult->paginate(15);
            return view('report.reportList', ['reports' => $reports]);

        }else{
            $queryResult = $queryResult->paginate(40);
            return view('gridList',['list' => $queryResult, 'title' => $searchBy]);
        }
    }

    public function getReportsByTag($tag){
        $user = Auth::user();
        $userGroups = $user->getGroupsID();
        $tag = str_replace('-',' ',$tag);
        $Tag = Tag::where('name', '=',$tag)->first();
        if(!$Tag){
            return redirect()->action(
                'ReportController@getReportList', ['type'=>'danger','message' => 'no reports with such tag']
            );
        }
        $reports=$Tag->reports()->whereIn('group_id',$userGroups)->paginate(15);
        return view('report.reportList', ['reports' => $reports]);
    }

    //returns the edit form
    public function edit($id){
        $report = Report::find($id);
        return view('report.editReport', ['report' => $report]);
    }

    public function update(CreateReport $request, $id){
        $request->validated();
        $report = Report::find($id);
        $data = $this->extractFormData($request);
        $report->update($request->Input());

        if($data['tag']){
            $report->tags()->detach();
            $this->createTags($data, $report);
        }

        $this->storeFiles($data,$report->id);
        $report->save();
        return view('report.editReport', ['report' => $report]);
    }


    public function delete($id)
    {
        # code...
        $user = Auth::user();
        $GroupsIDs=$user->getGroupsID();
        $report=Report::whereIn('group_id',$GroupsIDs)->where('id',$id);
        if($report){
            $report->delete();
            return redirect()->action(
                'ReportController@getReportList', ['type'=>'success','message' => 'Report delete!']
            );
        }else
            return redirect()->action(
                'ReportController@getReportList', ['type'=>'danger','message' => 'no such Report!']
            );

    }

    /*
        Helpers
    */
    public function prepareReports($reports)
    {
        $reports = ReportResource::collection(($reports))->toArray(null);
        $reports=$this->paginate($reports);
        return $reports;
    }
    public function querySearch($searchBy, $searchVal)
    {
        $user = Auth::user();
        $userGroupsIds = $user->getGroupsID();
        switch ($searchBy) {
            case 'author':
            $authors=User::where('name', 'like', '%'.$searchVal.'%');
            return($authors);
            case 'tag':
                $tags = Tag::where('name', 'like', '%'.$searchVal.'%');
                return($tags);
            case 'content':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('body','like','%'.$searchVal.'%');
                return($reports);
                break;
            case 'title':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('title','like','%'.$searchVal.'%');
                return($reports);
                break;
            case 'group':
                $groups = $user->groups()->get()->toArray();
                $matchedGroups=[];
                foreach ($groups as $group) {
                    if(preg_match('%'.$searchVal.'%', $group['name']))
                        $matchedGroups[]=$group;
                }
                return($matchedGroups);
            default:
                return null;
                break;
        }
    }

    public function createTags($request, $report){
        if($request['tag']){
            $tags=array_unique(explode(',', $request['tag']));
            foreach ($tags as $tag) {
                $tagInsert['name']=$tag;
                if(empty(ltrim(strtolower($tagInsert['name']))))
                    continue;

                $existingTag= Tag::where('name','=',ltrim(strtolower($tagInsert['name'])))->first();
                if($existingTag){
                    $report->tags()->attach($existingTag);
                    continue;
                }
                $tagInsert['name']=strtolower($tagInsert['name']);
                $tag=Tag::create($tagInsert);
                $report->tags()->attach($tag);
            }
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

    public function extractFormData($request){
        $data['title']= $request->input('title');
        $data['body']= $request->input('body');
        $data['tag']= $request->input('tags');
        $data['group_id']= $request->input('group');
        $data['author_id']=Auth::user()->id;
        $data['attachment']= $request->file('attachment');
        return $data;
    }

    public function getAuthorizedArticles()
    {
        $user = Auth::user();
        $GroupsIDs=$user->getGroupsID();
        $reports=Report::whereIn('group_id',$GroupsIDs)->paginate(15);
        return $reports;
    }

    public function getReportsByAuthor($author_name)
    {
        $user = Auth::user();
        $GroupsIDs=$user->getGroupsID();
        $author= User::where('name','=',$author_name)->first();
        if(!$author)
            return null;
        $author_id=$author->id;
        $reports=Report::whereIn('group_id',$GroupsIDs)->where('author_id','=',$author_id)->paginate(15);

        return $reports;
    }


}

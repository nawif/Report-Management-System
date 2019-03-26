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
        $this->getReportList();
        return $this->getReportList(['type'=>'success','message' => 'report  created successfully']);

    }

    public function getReportList($alert = null){
        $reportData = $this->getAuthorizedArticles();
        return view('report.reportList', ['reports' => $reportData , 'alert' => $alert]);

    }

    public function getAuthorReportList($author_name){
        $author_name = str_replace('-',' ',$author_name);
        $reports = $this->getReportsByAuthor($author_name);
        if($reports)
            return view('report.reportList', ['reports' => $reports]);
        else
            return $this->getReportList(['type'=>'danger','message' => 'there are no results that match your search']);
    }

    public function search(Request $request)
    {
        $searchBy = $request->get('searchBy');
        $searchVal = $request->get('searchVal');
        $queryResult = $this->querySearch($searchBy, $searchVal);
        if(!$queryResult)
            return $this->getReportList(['type'=>'danger','message' => 'there are no results that match your search']);
        if(in_array($searchBy,['content', 'title'])){
            $reports = $this->prepareReports($queryResult);
            return view('report.reportList', ['reports' => $reports]);

        }else{

        }
            return view('gridList',['list' => $queryResult, 'title' => $searchBy]);
    }

    public function getReportsByTag($tag){
        $user = Auth::user();
        $userGroups = $user->getGroupsID();
        $tag = str_replace('-',' ',$tag);
        $Tag = Tag::where('name', '=',$tag)->first();
        if(!$Tag){
            return $this->getReportList(['type'=>'danger','message' => 'no reports with such tag']);
        }
        $reports=$Tag->reports()->whereIn('group_id',$userGroups)->get();
        $reports = $this->prepareReports($reports);
        return view('report.reportList', ['reports' => $reports]);
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
            $authors=User::where('name', 'like', '%'.$searchVal.'%')->get()->toArray();
            return($authors);
            case 'tag':
                $tags = Tag::where('name', 'like', '%'.$searchVal.'%')->get()->toArray();
                return($tags);
            case 'content':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('body','like','%'.$searchVal.'%')->get();
                return($reports);
                break;
            case 'title':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('title','like','%'.$searchVal.'%')->get();
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
                $existingTag= Tag::where('name','=',strtolower($tagInsert['name']))->first();
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

    public function paginate($items, $perPage = 15, $page = null)
    {
        $options = ['path' => Paginator::resolveCurrentPath()];
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getAuthorizedArticles()
    {
        $user = Auth::user();
        $GroupsIDs=$user->getGroupsID();
        $reportsCollection=Report::whereIn('group_id',$GroupsIDs)->get();
        $reports= $this->prepareReports($reportsCollection);
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
        $reportsCollection=Report::whereIn('group_id',$GroupsIDs)->where('author_id','=',$author_id)->get();
        $reports= $this->prepareReports($reportsCollection);
        return $reports;
    }

}

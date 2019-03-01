<?php

namespace App\Http\Controllers;
use App\Report;
use App\Group;
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

class ReportController extends Controller
{
    /*
        Routes Method
    */
    public function getReport($id){
        $reportData= new ReportResource(Report::find($id));
        $reportData = $reportData->toArray($reportData);
        return view('report.reportPage',['reports'=> $reportData]);
    }

    public function getCreateReportPage(){
        $groups=Auth::user()->groups()->get();
        return view('report.createReport',['groups' => $groups]);
    }

    public function createReport(Request $request){
        $data=$this->extractFormData($request);
        $report= Report::create($data);
        $this->createTags($data, $report);
        $this->storeFiles($request, $report->id);
        $this->getReportList();
    }

    public function getReportList($alert = null){
        $reportData = Auth::user()->getAuthorizedArticles();
        return view('report.reportList', ['reports' => $reportData , 'alert' => $alert]);

    }

    public function getAuthorReportList($author_id)
    {
        $reports = Auth::user()->getReportsByAuthor($author_id);
        return view('report.reportList', ['reports' => $reports]);
    }

    public function search(Request $request)
    {
        $searchBy = $request->get('searchBy');
        $searchVal = $request->get('searchVal');
        $queryResault = $this->querySearch($searchBy, $searchVal);
        return view('gridList',['list' => $queryResault, 'title' => ($queryResault) ? $searchBy."s" : "" ]);
    }

    public function getReportsByTag($tag){
        $user = Auth::user();
        $userGroups = $user->getGroupsID();
        $Tag = Tag::where('name', '=',$tag)->first();
        if(!$Tag){
            return $this->getReportList(['type'=>'danger','message' => 'no reports with such tag']);
        }
        $reports=$Tag->reports()->whereIn('group_id',$userGroups)->get();
        $reports = ReportResource::collection(($reports))->toArray(null);
        $reports=$this->paginate($reports);
        return view('report.reportList', ['reports' => $reports]);
    }

    /*
        Helpers
    */

    public function querySearch($searchBy, $searchVal)
    {
        $user = Auth::user();
        $userGroupsIds = $user->groups()->get()->pluck('id')->toArray();
        switch ($searchBy) {
            case 'author':
            $authors=User::where('name', 'like', '%'.$searchVal.'%')->get()->toArray();
            return($authors);
            case 'tag':
                $tags = Tag::where('name', 'like', '%'.$searchVal.'%')->get()->toArray();
                return($tags);
            case 'content':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('body','like','%'.$searchVal.'%')->get();
                dd($reports);
                break;
            case 'title':
                $reports = Report::whereIn('group_id',$userGroupsIds)->where('title','like','%'.$searchVal.'%')->get();
                dd($reports);
                break;
            case 'group':
                $groups = $user->groups()->get()->toArray();
                return($groups);
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


}

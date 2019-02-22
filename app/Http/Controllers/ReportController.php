<?php

namespace App\Http\Controllers;
use App\Report;
use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tag;

class ReportController extends Controller
{
    public function getReport($id){
        $report = $this->getReport1($id);
        return view('report.reportPage',['report' => $report]);
    }

    public function getReport1($id){
        $report = Report::find($id);
        $report['author'] = $report->author()->first()->toArray();
        $report['tags'] = $report->tags->toArray();
        $report =$report -> toArray();
        return $report;
    }

    public function getCreateReportPage(){
        $groups=Group::all();
        return view('report.createReport',['groups' => $groups]);
    }

    public function createReport(Request $request){
        $data=$this->extractFormData($request);
        $report= Report::create($data);
        $this->createTag($data, $report);
        $this->storeFiles($request);
        return view('report.createReport',['groups' => $groups]);
    }

    public function createTags($request, $report){
        if($request['tag']){
            $tags=explode(',', $request['tag']);
            foreach ($tags as $tag) {
                $tagInsert['name']=$tag;
                $tag=Tag::create($tagInsert);
                $report->tags()->attach($tag);
            }
        }
    }

    public function storeFiles($request)
    {
        
    }

    public function extractFormData($request){
        $data['title']= $request->input('title');
        $data['body']= $request->input('body');
        $data['tag']= $request->input('tags');
        $data['group']= $request->input('group');
        $data['author_id']=Auth::user()->id;
        $data['attachment']= $request->file('attachment');
        return $data;
    }
}

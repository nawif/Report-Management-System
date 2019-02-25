<?php

namespace App\Http\Controllers;
use App\Report;
use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use File;
use App\ReportMultimedia;
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
        return view('report.createReport',['groups' => $groups]);
    }

    public function getReportList($pageNum){
        $reportPerPage = 10;
        $reportData = Auth::user()->getAuthorizedArticles($pageNum,$reportPerPage);
        $reportData['hasNext'] = false;
        return view('report.reportList', ['reports' => $reportData , 'currentPage' => $pageNum]);

    }

    public function getAuthorReportList($author_id, $pageNum)
    {
        $reportPerPage = 10;
        $report = Auth::user()->getReportsByAuthor($author_id,$pageNum,$reportPerPage);
        dd($report);
    }


    /*
        Helpers
    */

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

}

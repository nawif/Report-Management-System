<?php

namespace App\Http\Controllers;
use App\Report;
use App\Group;


use Illuminate\Http\Request;

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

    public function getCreateReportPage(Request $request){
        $groups=Group::all();
        // dd($groups->name);
        return view('report.createReport',['groups' => $groups]);

    }
    public function createReport(Request $request){
        $groups=Group::all();
        dd($this->extractFormData($request));
        return view('report.createReport',['groups' => $groups]);
    }

    public function extractFormData($request)
    {
        $data['title']= $request->input('title');
        $data['body']= $request->input('body');
        $data['tags']= $request->input('tags');
        $data['group']= $request->input('group');
        return $data;
    }
}

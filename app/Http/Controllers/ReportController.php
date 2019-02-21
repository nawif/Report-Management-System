<?php

namespace App\Http\Controllers;
use App\Report;

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

    public function createReport(Request $request){
        return view('report.createReport');

    }
}

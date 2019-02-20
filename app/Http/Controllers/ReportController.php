<?php

namespace App\Http\Controllers;
use App\Report;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReport($id){
        $report = Report::find($id);
        $report['author'] = $report->author()->first()->toArray();
        $report['tags'] = $report->tags->toArray();
        $report =$report -> toArray();
        return view('report.reportPage',['report' => $report]);
    }
}

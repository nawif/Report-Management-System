<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReport($id){

        return view('report.reportPage',['name' => 'hello world']);
    }
}

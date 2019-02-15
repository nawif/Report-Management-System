<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMultimedia extends Model
{
    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTag extends Model
{
    public function reports()
    {
        return $this->belongsToMany('App\Report');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}

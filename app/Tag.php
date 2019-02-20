<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function reports()
    {
        return $this->belongsToMany('App\Report','report_tags') ;
    }
}

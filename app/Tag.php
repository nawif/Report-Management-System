<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function reportTag()
    {
        return $this->hasMany('App\ReportTag');
    }
}

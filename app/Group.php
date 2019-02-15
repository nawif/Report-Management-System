<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function reports()
    {
        return $this->belongsToMany('App\Report');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\GroupPermission');
    }
    
}

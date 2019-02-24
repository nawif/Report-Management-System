<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function reports()
    {
        return $this->belongsToMany('App\Report');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany('App\GroupPermission');
    }

}

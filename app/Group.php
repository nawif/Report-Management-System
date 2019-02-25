<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User','users_groups') ;
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['title','body', 'author_id'];


    public function multimedia()
    {
        return $this->hasMany('App\ReportMultimedia');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag','report_tags') ;
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

}

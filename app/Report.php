<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['title','body', 'author_id', 'group_id'];


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

    public function group()
    {
        return $this->belongsTo('App\Group');
    }


    public function getThumbnail()
    {
        foreach ($this->multimedia()->get() as $multimedia) {
            $file = Storage::mimeType($multimedia->path);
            if (substr($file, 0, 5) == 'image') {
                return $multimedia->id;
            }
        }
    }

}

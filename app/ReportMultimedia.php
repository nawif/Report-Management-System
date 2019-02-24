<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReportMultimedia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['path', 'title', 'report_id'];
    public function report()
    {
        return $this->belongsTo('App\Report');
    }

    public function getURL()
    {
        return asset(Storage::url($this->path));
    }
}

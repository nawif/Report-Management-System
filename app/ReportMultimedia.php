<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

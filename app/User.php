<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Resources\Report as ReportResource;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group','users_groups') ;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','users_roles') ;
    }

    public function getAuthorizedArticles($skipBy, $limit)
    {
        $reportData= new ReportResource(Report::where('group_id','=',$this->group_id)->skip($skipBy)->take($limit));
        return $reportData->toArray($reportData);
    }

}

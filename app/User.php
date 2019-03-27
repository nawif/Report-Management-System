<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Resources\Report as ReportResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
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
        return $this->hasMany('App\Report','author_id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group','users_groups') ;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','users_roles') ;
    }

    public function getGroupsID()
    {
        return $this->groups()->pluck('id')->toArray();
    }

    public function canCreate()
    {
        return $this->roles()->get()->contains('name', "Create");
    }

    public function canEdit()
    {
        return $this->roles()->get()->contains('name', "Edit");
    }

    public function canDelete()
    {
        return $this->roles()->get()->contains('name', "Delete");
    }

    public function canView()
    {
        return $this->roles()->get()->contains('name', "View");
    }

}

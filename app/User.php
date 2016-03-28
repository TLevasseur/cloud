<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groupsOwned()
    {
        return $this->hasMany('App\Group','group_owner_id');
    }

    public function groups(){
        return $this->belongsToMany('App\group','users_user_group','user_id','group_id');
    }

    public function userGroup(){
        return $this->hasMany('App\UserGroup','user_id');
    }
}

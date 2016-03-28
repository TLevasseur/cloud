<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Group extends Model
{
    use SoftDeletes;	
	protected $table = 'user_groups';
    protected $fillable = [
        'name','group_owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function member(){
        return $this->belongsToMany('App\User','users_user_group','group_id','user_id');
    }
    public function userGroup(){
        return $this->hasMany('App\UserGroup','group_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserGroup extends Model
{
    use SoftDeletes;	
	protected $table = 'users_user_group';
    protected $fillable = [
        'group_id','user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function group(){
        return $this->belongsTo('App\Group','group_id');
    }
}

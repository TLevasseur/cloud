<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\UserGroup;
use App\Group;
use App\User;
use Auth;
use File;
use Storage;
use Response;
class GroupController extends Controller
{
    public function newgroup(Request $request)
    {
        if($group=Group::create(array('name'=> $request->get('groupName'), 'group_owner_id' =>Auth::user()->id))){
			UserGroup::create(array('group_id'=>$group->id,'user_id'=>Auth::user()->id));
			Storage::makeDirectory($group->id);
        	return Redirect::to('home')->with('success','Group successfuly created.');
        }
        	return Redirect::to('home')->with('error','Oups, something went wrong.');
    }

    public function show($id){
    	if($group=Group::where("id","=",$id)->first()){
    		return View::make('group',array('group'=>$group));
    	}else{
    		return Redirect::to('home')->with('error','Sorry that page does not exist.');
    	}
    }


    public function adduser(Request $request, $id)
    {
        if($user=User::where('email','=',$request->get('email'))->first()){
        	if(UserGroup::where('group_id','=',$id)->where('user_id','=',$user->id)->first())
        		return Redirect::to('group/'.$id)->with('info','User already in the group');
			UserGroup::create(array('group_id'=>$id,'user_id'=> $user->id));
        	return Redirect::to('group/'.$id)->with('success','User successfuly added.');
        }
    	return Redirect::to('group/'.$id)->with('error','Oups, something went wrong.');
    }

    public function addfile(Request $request, $id){
    	Storage::disk()->put($id.'/'.$request->file->getClientOriginalName(),File::get($request->file));
    }

    public function downloadfile($id,$fileName){
		$file = Storage::disk('local')->get($id.'/'.$fileName);
		return response()->download(storage_path('app/'.$id.'/'.$fileName), $fileName, ['Content-Type' => Storage::mimeType($id.'/'.$fileName)]);
    }

    public function deletefile($id,$fileName){
		if(Storage::delete($id.'/'.$fileName))
			return Redirect::to('group/'.$id)->with('success','File successfuly deleted.');
		return Redirect::to('group/'.$id)->with('error','Oups, something went wrong.');
    }
}

 {{--*/use App\UserGroup/*--}}
 {{--*/use App\Group/*--}}
@extends('layouts.default')


@section('pagetitle')
    Hello !
@endsection


@section('subheading')
    Team up time
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <h3>Create a new group</h3>
            {{ Form::open(array('url' => 'newgroup')) }}
                <div class="col-md-6">
                    {{Form::text('groupName','',array('class' => "form-control",'placeholder'=>"my group name"))}}
                </div>
                {{Form::submit('Create !', array('class' => "btn btn-primary"))}}
            {{ Form::close() }}
          </div>
        </div>
        <div>
            {{--*/$group=UserGroup::where("user_id","=",Auth::user()->id)->get()/*--}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Owner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($group as $groups)
                    <tr>
                        
                        <td>{{$groups->group->name}}</td>
                        <td>{{$groups->user->name}}</td>
                        <td><a href="group/{{$groups->group->id}}"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

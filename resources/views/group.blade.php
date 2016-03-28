{{--*/use App\UserGroup/*--}}
{{--*/use App\Group/*--}}
@extends('layouts.default')


@section('pagetitle')
    {{$group->name}}
@endsection


@section('script')
    {{ Html::script('js/dropzone.js') }}
    <script>
    Dropzone.options.mydz = {
    dictDefaultMessage: "",
	    init: function () {
	        this.on("complete", function (file) {
	            location.reload(); 
	        });
		}
	};
	</script>
@endsection

@section('content')
    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
          	Files
          </div>
          <div class="panel-body">
          	{{ Form::open(array('url' => 'group/'.$group->id.'/groupaddfile','class' => 'dropzone', 'id'=>'mydz')) }}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach(Storage::files($group->id) as $files)
                    <tr>
                        <td>{{explode('/',$files)[1]}}</td>
                        <td>{{date("Y-m-d H:i:s",Storage::lastModified($files))}}</td>
                        <td><a href='{{$group->id."/downloadfile/".explode('/',$files)[1]}}' target="_blank"><i class="fa fa-download"></i></a> <a href='{{$group->id."/deletefile/".explode('/',$files)[1]}}'><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ Form::close() }}
          </div>
        </div>
    </div>
    <div class="col-md-4 col-xs-12">
    	<div class="panel panel-default">
		  <div class="panel-heading">Members</div>
		  <div class="panel-body">
		  	<ul class="list-group">
		  		@foreach($group->member as $m)
			  	<li class="list-group-item">
			    	{{$m->name}}
				    @if($m->id == $group->group_owner_id)
				    <span class="label label-default pull-xs-right"><i class="fa fa-star"></i></span>
				    @endif
			  	</li>
				@endforeach
			</ul>
			@if(Auth::user()->id == $group->group_owner_id)
				{{ Form::open(array('url' => 'group/'.$group->id.'/groupadduser')) }}
	                <div class="col-md-6">
	                    {{Form::text('email','',array('class' => "form-control",'placeholder'=>"email@domain.ex","type"=>"email"))}}
	                </div>
	                {{Form::submit('Add user', array('class' => "btn btn-primary"))}}
				{{ Form::close() }}
			@endif
		  </div>
		</div>
    </div>
@endsection

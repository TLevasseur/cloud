<!DOCTYPE html>
<html lang="en">
 {{--*/use App\UserGroup/*--}}
 {{--*/use App\Group/*--}}
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}
    <!-- Custom CSS -->

    {{ Html::style('css/sb-admin.css') }}
    <!-- Custom Fonts -->
    {{ Html::style('font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('css/toastr.min.css') }}
    @yield('style')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/home') }}">Cloud Computing</a>
            </div>
            <!-- /.navbar-collapse -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ url('/home') }}"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> My groups <i class="fa fa-fw fa-caret-down"></i></a>
                        {{--*/$group=UserGroup::where("user_id","=",Auth::user()->id)->get()/*--}}
                        <ul id="demo" class="collapse">
                            @foreach($group as $groups)
                            <li>
                                <a href="{{ url('/group/'.$groups->group->id) }}">{{$groups->group->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            @yield('pagetitle')
                            <small>@yield('subheading')</small>
                        </h1>
                    </div>
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    {{ HTML::script('js/jquery.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }}

    {{ HTML::script('js/toastr.min.js') }}
    @yield('script')
    <script>
    @if(session('success'))
        toastr.success("{{{session('success')}}}");
    @endif
    @if(session('error'))
        toastr.error("{{{session('error')}}}");
    @endif
    @if(session('info'))
        toastr.info("{{session('info')}}");
    @endif
    </script>
</body>

</html>

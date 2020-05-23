<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title>FAQ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! Charts::styles() !!}
    <title>{{ config('app.name', 'FAQ') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>

    <div class=".container">
        <div class="row justify-content-center">
            <h1>@lang('Adminhome.Administrator')</h1>
        </div>
        <div class="row justify-content-center">
        <div class="form-inlin pr-4">
            <ul >

                <li style="display: inline;float: left;" class="pr-2"><a href="../locale/en"><img src=" {{ asset('images/E.png') }} " class="media-object" style="width:60px"></a></li>
                <li style="display: inline;float: left;"><a href="../locale/jp"><img src=" {{ asset('images/J.png') }} " class="media-object" style="width:60px"></a></li>

          </ul>
          </div>
        </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-3">
            <div class="container">
                <a class="navbar-brand">
                    {{ config('app.name', 'FAQ') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mr-3 ml-2">
                            <a class="nav-link" href="/admin/users">@lang('Adminhome.Home')</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="/adminregister">@lang('Adminhome.User_Registration')</a>
                        </li>

                        <li class="nav-item mr-3">
                            <a class="nav-link" href="/admincategories">@lang('Adminhome.Category_Setup')</a>
                        </li>
                        <li class="nav-item dropdown mr-3">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">@lang('Adminhome.Database')</a>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="/questions_ranking">@lang('Adminhome.Question')</a>
                                <a class="dropdown-item" href="/answers_ranking">@lang('Adminhome.Answer')</a>

                            </div>
                        </li>
                        <!--
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Logs</a>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="/logs">Access Log</a>
                                <a class="dropdown-item" href="/admincreatelogs">Create Log</a>
                            </div>
                        </li>-->
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="/admingraph">@lang('Adminhome.Graphs_&_Charts')</a>
                        </li>


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@lang('Adminhome.Log_In')</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">@lang('Adminhome.Register')</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('Adminhome.Log_Out')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>

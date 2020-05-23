<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <title>FAQ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
        table tr{
                cursor: pointer;transition: all .25s ease-in-out;
            }
            table tr:hover{background-color: #ccc;}
  </style>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<!--Body-->

<body >

<!--Logo Bar-->
<div class=".container-fluid bg-success text-white" >
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 "></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">

    <h1 align="center">F A Q</h1>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 "></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
    <div class="form-inlin" style="align:right">
      <ul >

      <li style="display: inline;float: left;" class="pr-2"><a href="locale/en"><img src=" {{ asset('images/E.png') }} " class="media-object" style="width:60px"></a></li>
      <li style="display: inline;float: left;"><a href="locale/jp"><img src=" {{ asset('images/J.png') }} " class="media-object" style="width:60px"></a></li>

    </ul>
    </div>
        </div>
    </div>

  <div class="row justify-content-center">
		<p>@lang('Userhome.user_nav_msg')</p>
  </div>

</div>

@include('inc.navbaruser')
@yield('content')
<br>
<footer class="container-fluid text-center text-white bg-success p-3">
    <a title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>@lang('Userhome.user_foot_msg')</p>
  </footer>
</body>
</html>


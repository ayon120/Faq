@extends('layouts.userlayout')

@section('content')
<div class="container p-3">
<div class="d-flex justify-content-center">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item pr-3">
    <a class="nav-link active bg-success text-white" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="true">@lang('Userhome.notice_news')</a>
  </li>
  <li class="nav-item">
    <a class="nav-link bg-success text-white" id="pills-event-tab" data-toggle="pill" href="#pills-event" role="tab" aria-controls="pills-event" aria-selected="false">@lang('Userhome.notice_event')</a>
  </li>
  <li class="nav-item pl-3">
    <a class="nav-link bg-success text-white" id="pills-notice-tab" data-toggle="pill" href="#pills-notice" role="tab" aria-controls="pills-notice" aria-selected="false">@lang('Userhome.notice_notice')</a>
  </li>
</ul>
</div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pr-2" style="height: 800px; overflow-y: auto;"  >
  <!--Display Table-->
    <table class="table mb-0" id="table">
      <thead class="bg-success text-white ">
        <tr>
          <th scope="col">@lang('Userhome.notice_no')</th>
          <th scope="col">@lang('Userhome.notice_news')</th>
        </tr>
      </thead>
	  <tbody>
    <script>var j=1;</script>
    @foreach($all as $i)
        @if($i->topic=='news')
		        <tr>
			          <td><script>document.write(j+".");j=j+1;</script></td>
                <td>{{$i->content}}</td>
		        </tr>
          @endif

        @endforeach
	  </tbody>
    </table>
  </div>
  </div>
  <div class="tab-pane fade" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pr-2" style="height: 500px; overflow-y: auto;"  >
  <!--Display Table-->
    <table class="table mb-0" id="table">
      <thead class="bg-success text-white">
        <tr>

            <th scope="col">@lang('Userhome.notice_no')</th>
            <th scope="col">@lang('Userhome.notice_event')</th>
        </tr>
      </thead>
	  <tbody>
    <script>var j=1;</script>
    @foreach($all as $i)
        @if($i->topic=='event')
		        <tr>
			          <td><script>document.write(j+".");j=j+1;</script></td>
                <td>{{$i->content}}</td>
		        </tr>
          @endif
        @endforeach
	  </tbody>
    </table>
  </div>
  </div>
  <div class="tab-pane fade" id="pills-notice" role="tabpanel" aria-labelledby="pills-notice-tab">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pr-2" style="height: 500px; overflow-y: auto;"  >
  <!--Display Table-->
    <table class="table mb-0" id="table">
      <thead class="bg-success text-white">
        <tr>

            <th scope="col">@lang('Userhome.notice_no')</th>
            <th scope="col">@lang('Userhome.notice_notice')</th>
        </tr>
      </thead>
	  <tbody>
    <script>var j=1;</script>
    @foreach($all as $i)
        @if($i->topic=='notice')
		        <tr>
			          <td><script>document.write(j+".");j=j+1;</script></td>
                <td>{{$i->content}}</td>
		        </tr>
          @endif
        @endforeach

	  </tbody>
    </table>
  </div>
  </div>
</div>

  </div>


@endsection

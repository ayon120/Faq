@extends('layouts.adminlayout')
@section('content')
<div class="container">


<div class="row p-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2 card" >
        <div class="d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" id="pills-tab1" role="tablist">
            <li class="nav-item pr-3">
              <a class="nav-link active " id="tab" href="#" data-toggle="pill" value="week" role="tab" aria-controls="pills-week" aria-selected="true">@lang('Adminhome.Weekly')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="tab" href="#" data-toggle="pill" value="month" role="tab" aria-controls="pills-month" aria-selected="false">@lang('Adminhome.Monthly')</a>
            </li>
            <li class="nav-item pl-3">
              <a class="nav-link " id="tab" href="#" data-toggle="pill" value="year" role="tab" aria-controls="pills-year" aria-selected="false">@lang('Adminhome.Yearly')</a>
            </li>
          </ul>
        </div>

          <div class="tab-content" id="pills-tabContent1">
            <div class="tab-pane fade show active" id="id" role="tabpanel" aria-labelledby="pills-catweek-tab">

            </div>
        </div>

    </div>



</div>


<div class="row p-3">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2 card" >
      <div class="d-flex justify-content-center">
          <ul class="nav nav-pills mb-3" id="pills-tab1" role="tablist">
          <li class="nav-item pr-3">
            <a class="nav-link active " id="hitWMY" href="#" data-toggle="pill" value="week" role="tab" aria-controls="pills-week" aria-selected="true">@lang('Adminhome.Weekly')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " id="hitWMY" href="#" data-toggle="pill" value="month" role="tab" aria-controls="pills-month" aria-selected="false">@lang('Adminhome.Monthly')</a>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link " id="hitWMY" href="#" data-toggle="pill" value="year" role="tab" aria-controls="pills-year" aria-selected="false">@lang('Adminhome.Yearly')</a>
          </li>
        </ul>
      </div>

        <div class="tab-content" id="pills-tabContent1">
          <div class="tab-pane fade show active" id="hit" role="tabpanel" aria-labelledby="pills-catweek-tab">

          </div>
      </div>

  </div>



</div>


<div class="row p-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2 card" >
        <div class="d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" id="pills-tab1" role="tablist">
            <li class="nav-item pr-3">
              <a class="nav-link active " id="quesWMY" href="#" data-toggle="pill" value="week" role="tab" aria-controls="pills-week" aria-selected="true">@lang('Adminhome.Weekly')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="quesWMY" href="#" data-toggle="pill" value="month" role="tab" aria-controls="pills-month" aria-selected="false">@lang('Adminhome.Monthly')</a>
            </li>
            <li class="nav-item pl-3">
              <a class="nav-link " id="quesWMY" href="#" data-toggle="pill" value="year" role="tab" aria-controls="pills-year" aria-selected="false">@lang('Adminhome.Yearly')</a>
            </li>
          </ul>
        </div>

          <div class="tab-content" id="pills-tabContent1">
            <div class="tab-pane fade show active" id="ques" role="tabpanel" aria-labelledby="pills-catweek-tab">

            </div>
        </div>

    </div>



  </div>



  <div class="row p-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2 card" >
        <div class="d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" id="pills-tab1" role="tablist">
            <li class="nav-item pr-3">
              <a class="nav-link active " id="accessWMY" href="#" data-toggle="pill" value="week" role="tab" aria-controls="pills-week" aria-selected="true">@lang('Adminhome.Weekly')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="accessWMY" href="#" data-toggle="pill" value="month" role="tab" aria-controls="pills-month" aria-selected="false">@lang('Adminhome.Monthly')</a>
            </li>
            <li class="nav-item pl-3">
              <a class="nav-link " id="accessWMY" href="#" data-toggle="pill" value="year" role="tab" aria-controls="pills-year" aria-selected="false">@lang('Adminhome.Yearly')</a>
            </li>
          </ul>
        </div>

          <div class="tab-content" id="pills-tabContent1">
            <div class="tab-pane fade show active" id="access" role="tabpanel" aria-labelledby="pills-catweek-tab">

            </div>
        </div>

    </div>



  </div>


<script>
    $(document).ready(function(){
     //var cat = $('#categories').val();
     //console.log(cat);
     fetch_data('week');
     fetch_hit_count('week')
     fetch_ques_count('week');
     access_data('week');

     function fetch_data(value)
     {
      $.ajax({
       url:"{{ route('chart.makebarchart') }}",
       method:'GET',
       data:{'value':value},
       dataType:'json',

       success:function(chart)
       {
        //console.log(chart.doc);
        $('#id').highcharts({
          chart: {
            type: chart.type
            },
          title: {
            text: chart.title
            },
          xAxis: {
            categories: chart.category
            },
          yAxis: {
            title: {
              text: 'Rate'
              }
            },
          series: [{
            name: 'Number of Persons Registered',
            data: chart.doc
            }]
            });
          }
        })
      }

    $(document).on('click', '#tab', function(){
  var id = $(this).attr("value");
  fetch_data(id);
 });


 function fetch_hit_count(value)
     {
      $.ajax({
       url:"{{ route('chart.makehitcountchart') }}",
       method:'GET',
       data:{'value':value},
       dataType:'json',

       success:function(chart)
       {
        console.log(chart);
        var arr = [];
        for (var i = 0; i < chart.doc.length; i++) {
          var person = new Object();
          person.name = chart.category[i];
          person.y = chart.doc[i];
          console.log(person);
          arr.push(person)
        }
        console.log(arr);
        $('#hit').highcharts({
          chart: {
            type: chart.type
            },
          title: {
            text: chart.title
            },
            tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
          series: [{
            name: 'Frequently Asked Category',
            data: arr
            }]
            });
          }
        })
      }

    $(document).on('click', '#hitWMY', function(){
      var id = $(this).attr("value");
      fetch_hit_count(id);
      });



      function fetch_ques_count(value)
     {
      $.ajax({
       url:"{{ route('chart.makequeschart') }}",
       method:'GET',
       data:{'value':value},
       dataType:'json',

       success:function(chart)
       {
        //console.log(chart.doc);
        $('#ques').highcharts({
          chart: {
            type: chart.type
            },
          title: {
            text: chart.title
            },
          xAxis: {
            categories: chart.category
            },
          yAxis: {
            title: {
              text: 'Rate'
              }
            },
          series: [{
            name: 'Frequently Asked Questions',
            data: chart.doc
            }]
            });
          }
        })
      }

    $(document).on('click', '#quesWMY', function(){
      var id = $(this).attr("value");
      fetch_ques_count(id);
      });


      function access_data(value)
     {
      $.ajax({
       url:"{{ route('chart.accesschart') }}",
       method:'GET',
       data:{'value':value},
       dataType:'json',

       success:function(chart)
       {
        console.log(chart.doc);
        $('#access').highcharts({
          chart: {
            type: chart.type
            },
          title: {
            text: chart.title
            },
          xAxis: {
            categories: chart.category
            },
          yAxis: {
            title: {
              text: 'Rate'
              }
            },
          series: [{
            name: 'Number of Persons Accessed',
            data: chart.doc
            }]
            });
          }
        })
      }

    $(document).on('click', '#accessWMY', function(){
  var id = $(this).attr("value");
  access_data(id);
 });

    });
    </script>
</div>
@endsection

@extends('layouts.userlayout')

@section('content')
<div class="container pt-3">

  <div class="container box">

   <div class="panel panel-default">
    <div class="panel-body ">
        <p></p>
		<div class="form-row">
        <div class="form-group col-sm-3 pr-3">
            <select name="categories" id="categories" class="form-control" required>
                <option value="0" selected>@lang('Userhome.user_category')</option>
                @foreach($categories as $category)

                    <option value="{{ $category->id }}">{{ $category->category }}</option>

                @endforeach
            </select>
        </div>
     <div class="form-group col-sm-9">
      <input type="text" name="search" id="search" class="form-control" placeholder="@lang('Userhome.user_search')" />
     </div>
	 </div>
	 <div class="form-row pt-3"  >
	 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 card ">
     <div class="table-responsive">
      <p align="right" id="total_records"></p>
      <table class="table mb-0" id="table" style="display: -moz-groupbox;">
       <thead class="bg-success text-white" align="center">
        <tr>
         <th>@lang('Userhome.user_questions')</th>
        </tr>
       </thead>
       <tbody id="tbodyques" style="overflow-y: scroll; height: 445px; width: 99%; position: absolute;">

       </tbody>
      </table>



     </div>
	 </div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" ></div>
	   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5  " >
  <!--Question Display table-->

	<div class="card" style="height: 200px; overflow-y: auto;">

    <table class="table mb-0" >
      <thead class="bg-success text-white" align="center">
        <tr>
          <th scope="col">@lang('Userhome.user_question')</th>
        </tr>
      </thead>
	  <tbody>
		<tr>
			<td id="tab" name="tab"></td>
		<tr>
	  </tbody>

	</table>
	</div>
	<!--Answer Display Table-->
	<div class="card" style="height: 338px; overflow-y: auto;">
	<table class="table mb-0">
      <thead class="bg-success text-white" align="center">
        <tr>
          <th scope="col">@lang('Userhome.user_ans')</th>
        </tr>
      </thead>
	   <tbody id="ayon" name="ayon">

	  </tbody>
	</table>
	</div>
  </div>
  </div>
    </div>
   </div>
  </div>
  <br/>

  <!--Fake Questions-->
  <!-- Left-aligned media object -->
  <h4 align="center">@lang('Userhome.user_sampleQA')</h4>
  <div class="p-3">
  <hr>
  <div class="media">
    <div class="media-left">
	<img src=" {{ asset('images/mu.png') }} " class="media-object" style="width:60px">
    </div>
    <div class="media-body">
      <h4 class="media-heading">Mr. Johnson Smith</h4>
      <p>What is your name?</p>
    </div>
  </div>
  <hr>
  <div class="media">
    <div class="media-left">
      <img src=" {{asset('images/fu.png')}} " class="media-object" style="width:60px">
    </div>
    <div class="media-body">
      <h4 class="media-heading">Miss Tomata</h4>
      <p>What is your name? Where do you live? What do you do? What is your job? What are you doing?</p>
    </div>
  </div>
  <hr>
  </div>

</div>

<script>
$(document).ready(function(){
 //var cat = $('#categories').val();
 //console.log(cat);
 fetch_data();

 function fetch_data(query = '',singleValues='0')
 {
  $.ajax({
   url:"{{ route('userhome.action') }}",
   method:'GET',
   data:{'query':query,'categories':singleValues},
   dataType:'json',

   success:function(data)
   {
    console.log(data);
    $('#tbodyques').html(data.table_data);
    $('#total_records').text(data.total_data);
    var table = document.getElementById('table');

        for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                     //rIndex = this.rowIndex;
                     var ques_id = this.cells[0].id;
                     document.getElementById("tab").innerHTML = this.cells[0].innerHTML;
                     console.log(ques_id);
                     $.ajax({
                    url:"{{ route('userhome.answer_action') }}",
                    method:'GET',
                    data:{'ques_id':ques_id},
                    dataType:'json',

                    success:function(ans)
                    {
                        $('#ayon').html(ans);
                    }
                     })
                };
            }
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  var singleValues = $( "#categories" ).val();
  fetch_data(query,singleValues);
 });


 $("#categories").change(displayVals);
 function displayVals() {
  var singleValues = $( "#categories" ).val();
  //$( "p" ).html( "<b>Category:</b> " + singleValues );
  var query = $('#search').val();
  fetch_data(query,singleValues);
}

 //$("#categories").change(displayVals);
 //displayVals();
});
</script>
@endsection

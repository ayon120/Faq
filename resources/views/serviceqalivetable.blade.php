@extends('layouts.servicelayout')

@section('content')
<div class="container pt-3">

  <div class="container box">
   <div class="panel panel-default">
    <div class="panel-body ">


		<div class="form-row">

        <div class="form-group col-sm-3 pr-3">
            <select name="categories" id="categories" class="form-control" required>
                <option value="0" selected>@lang('Serverhome.qa_category')</option>
                @foreach($categories as $category)

                    <option value="{{ $category->id }}">{{ $category->category }}</option>

                @endforeach
            </select>
        </div>
     <div class="form-group col-sm-9">
      <input type="text" name="search" id="search" class="form-control" placeholder="@lang('Serverhome.qa_search')" />
     </div>
	 </div>
	 <div class="form-row pt-5"  >

   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 p-3">
   <div id="message"></div>
     <div class="table-responsive">

      <table class="table mb-0" id="table" style="display: -moz-groupbox;">
       <thead class="bg-success text-white">
        <tr>
          <th>@lang('Serverhome.qa_questions')</th>
          <th></th>
          <th id="total_records" style="text-align:right;"></th>
        </tr>
       </thead>
       <tbody id="tbodyques" style="overflow-y: scroll; height: 450px; width: 95%; position: absolute;" >

       </tbody>
      </table>



     </div>
   </div>


	   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 p-3"  style="height: 500px; overflow-y: auto;" >
     <div id="ans_message"></div>
  <!--Answer Display Table-->

	<table class="table mb-0">
      <thead class="bg-success text-white">
        <tr>
          <th scope="col">@lang('Serverhome.qa_ans')</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
	   <tbody id="ayon" name="ayon">

	  </tbody>
  </table>
  {{ csrf_field() }}

  </div>
  </div>
    </div>
   </div>
  </div>
  <br/>


</div>

<script>

//Initial data loading
$(document).ready(function(){
 fetch_data();

 //Fetch question
 function fetch_data(query = '',singleValues='0')
 {
  $.ajax({
   url:"{{ route('serviceqalivetable.action') }}",
   method:'GET',
   data:{'query':query,'categories':singleValues},
   dataType:'json',

   success:function(data)
   {
    var t_data = data.table_data;
    var html = '';
    for(var count=0; count < t_data.length; count++)
    {
     html +='<tr>';
     html += '<td contenteditable class="column_name" id="question_col" data-column_name="question" data-id="'+t_data[count].id+'">'+t_data[count].question+'</td>';
     html += '<td><button type="button" class="btn btn-danger delete" style="float: right;" id="delete" value="'+t_data[count].id+'">@lang('Serverhome.qa_del')</button></td>';
     html += '<td align="center"><button type="button" class="btn btn-success" style="float: right;" id="view" value="'+t_data[count].id+'">@lang('Serverhome.qa_ans')</button></td></tr>';
    }
    $('#tbodyques').html(html);
    $('#total_records').text(data.total_data);
   }
  })
 }

 //Fetch answer
 function ans_fetch_data(ques_id)
 {
 $.ajax({
  url:"{{ route('serviceqalivetable.answer_action') }}",
  method:'GET',
  data:{'ques_id':ques_id},
  dataType:'json',

  success:function(ans)
  {
    var html = '';
    html += '<tr>';
    html += '<td contenteditable id="answer"></td>';
    html += '<td><button type="button" class="btn btn-success" style="float: right;" name="'+ques_id+'" id="add">@lang('Serverhome.qa_ins')</button></td></tr>';
    for(var count=0; count <ans.length; count++)
    {
     html +='<tr>';
     html += '<td contenteditable class="column_name" id="answer" data-column_name="answer" data-id="'+ans[count].id+'">'+ans[count].answer+'</td>';
     html += '<td ><button type="button" class="btn btn-danger delete" style="float: right;" name="'+ans[count].question_id+'" id="ans_delete" value="'+ans[count].id+'">@lang('Serverhome.qa_del')</button></td></tr>';
    }
    $('#ayon').html(html);
  }
   })
 }

 //Search key up
 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  var singleValues = $( "#categories" ).val();
  fetch_data(query,singleValues);
 });

//Category change
 $("#categories").change(displayVals);
 function displayVals() {
  var singleValues = $( "#categories" ).val();
  var query = $('#search').val();
  fetch_data(query,singleValues);
}

//Global csrf token
var _token = $('input[name="_token"]').val();


//Edit question
 $(document).on('blur', '#question_col', function(){
  var column_name = $(this).data("column_name");
  var column_value = $(this).text();
  var id = $(this).data("id");

  if(column_value != '')
  {
   $.ajax({
    url:"{{ route('serviceqalivetable.update_data') }}",
    method:"POST",
    data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
    }
   })
  }
  else
  {
   $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
  }
 });


//Delete question
 $(document).on('click', '#delete', function(){
  var id = $(this).attr("value");
  if(confirm("Are you sure you want to delete this records?"))
  {
   $.ajax({
    url:"{{ route('serviceqalivetable.delete_data') }}",
    method:"POST",
    data:{id:id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
     fetch_data();
    }
   });
  }
 });

 //View answer table
 $(document).on('click', '#view', function(){
  var ques_id = $(this).attr("value");
  ans_fetch_data(ques_id);
 });

//Delete answer
 $(document).on('click', '#ans_delete', function(){
  var id = $(this).attr("value");
  var ques_id = $(this).attr("name");
  if(confirm("Are you sure you want to delete this answer?"))
  {
   $.ajax({
    url:"{{ route('serviceqalivetable.ans_delete_data') }}",
    method:"POST",
    data:{id:id, _token:_token},
    success:function(data)
    {
     $('#ans_message').html(data);
     ans_fetch_data(ques_id);
    }
   });
  }
 });

 $(document).on('click', '#add', function(){
  var answer = $('#answer').text();
  var ques_id = $(this).attr("name");
  if(answer != '')
  {
   $.ajax({
    url:"{{ route('serviceqalivetable.ans_add_data') }}",
    method:"POST",
    data:{answer:answer, ques_id:ques_id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
     ans_fetch_data(ques_id);
    }
   });
  }
  else
  {
   $('#message').html("<div class='alert alert-danger'>Field is required</div>");
  }
 });

 //Edit answer
 $(document).on('blur', '#answer', function(){
  var column_name = $(this).attr('id');

  var column_value = $(this).text();

  var id = $(this).data("id");

  if(column_value != '')
  {
   $.ajax({
    url:"{{ route('serviceqalivetable.ans_update_data') }}",
    method:"POST",
    data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
    success:function(data)
    {
     $('#ans_message').html(data);
    }
   })
  }
  else
  {
   $('#ans_message').html("<div class='alert alert-danger'>Enter some value</div>");
  }
 });
});
</script>
@endsection

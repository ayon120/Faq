@extends('layouts.servicelayout')

@section('content')
<div class="container pt-3">

<div class="card">
    <div class="card-body">
   @if(session('success'))
    <div class="alert alert-success">
      <p>{{ session('success') }}</p>
    </div>
   @endif
  <form action="{{url('servicenoticestore')}}" method="post" class="needs-validation" novalidate>

      {{ csrf_field() }}

      <div class="form-group col-md-3">
        <h5>@lang('Serverhome.notice_ques')</h5>
      <select id="inputstate" name="inputstate" class="form-control">
        <option selected name="news" value="news">@lang('Serverhome.notice_news')</option>
        <option name="event" value="event">@lang('Serverhome.notice_event')</option>
        <option name="notice" value="notice">@lang('Serverhome.notice_notice')</option>
      </select>
    </div>

      <div class="form-group col-md-12">
        <textarea class="form-control" rows="3" id="writenews" name="writenews" placeholder="@lang('Serverhome.notice_insert')" required></textarea>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <div class="text-center"><button type="submit" class="btn btn-success" name="insert" value="insert" >@lang('Serverhome.notice_insert')</button></div>

    </form>
    </div>
  </div>
  <br>

  <div class="panel panel-default">

    <div class="panel-body">
     <div id="message"></div>
     <div class="table-responsive" style="height: 500px; overflow-y: auto;">
      <table class="table table-bordered">
       <thead class="bg-success text-white">
        <tr>
         <th>@lang('Serverhome.notice_topic')</th>
         <th>@lang('Serverhome.notice_content')</th>
         <th>@lang('Serverhome.notice_created')</th>
         <th>@lang('Serverhome.notice_action')</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>

      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>



  <script>
$(document).ready(function(){

 fetch_data();

 function fetch_data()
 {
  $.ajax({
   url:"/servicenotice/fetch_data",
   dataType:"json",
   success:function(data)
   {
    var html = '';
    //html += '<tr>';
   // html += '<td contenteditable id="first_name"></td>';
   // html += '<td contenteditable id="last_name"></td>';
    //html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
    for(var count=0; count < data.length; count++)
    {
     html +='<tr>';
     html +='<td class="column_name" data-column_name="topic" data-id="'+data[count].id+'">'+data[count].topic+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="content" data-id="'+data[count].id+'">'+data[count].content+'</td>';
     html +='<td class="column_name" data-column_name="created_at" data-id="'+data[count].id+'">'+data[count].created_at+'</td>';
     html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="add" value="'+data[count].id+'">@lang('Serverhome.qa_del')</button></td></tr>';
    }
    $('tbody').html(html);
   }
  });
 }

 var _token = $('input[name="_token"]').val();

 $(document).on('blur', '.column_name', function(){
  var column_name = $(this).data("column_name");
  var column_value = $(this).text();
  var id = $(this).data("id");

  if(column_value != '')
  {
   $.ajax({
    url:"{{ route('servicenotice.update_data') }}",
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


 $(document).on('click', '#add', function(){
  var id = $(this).attr("value");
  if(confirm("Are you sure you want to delete this records?"))
  {
   $.ajax({
    url:"{{ route('servicenotice.delete_data') }}",
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


});
</script>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
  @endsection

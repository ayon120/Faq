@extends('layouts.userlayout')

@section('content')
<div class="container p-3">

  <div class="card p-3">
  @if(session('success'))
    <div class="alert alert-success">
      <p>{{ session('success') }}</p>
    </div>
   @endif
      <form action="{{ route('useraskques') }}" method="POST" class="needs-validation" novalidate>
        {{ csrf_field() }}

        <textarea class="form-control" rows="3" id="title" name="ques" placeholder="@lang('Userhome.ask_bar')" required></textarea>
        <div class="invalid-feedback">Please fill out this field.</div>
</br>
        <input type="submit" class="btn btn-success" value="@lang('Userhome.ask_btn')"/>
      </form>
      </div>

      <div class="container box" style="height:650px">

      <h4 style="text-align:center;" class="p-3">@lang('Userhome.ask_recent')</h4>

      <div class="form-row pt-2"  >

   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

      <table class="table mb-0 border-dark" id="table" style="display: -moz-groupbox;">
       <thead class="bg-success text-white" style="">
        <tr>
          <th>@lang('Userhome.user_questions')</th>
          <th></th>
        </tr>
       </thead>
       <tbody style="overflow-y: scroll; height: 450px; width: 98%; position: absolute;" >
       @foreach($questions as $question)
          <tr>
              <td><p><strong>{{$question->question}}</strong></p></td>
              <td><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#show_ans" id="live_ans" name="{{$question->id}}">@lang('Userhome.ask_details')</button></td>
          </tr>
       @endforeach
       </tbody>
      </table>
   </div>
   <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
   <table class="table mb-0" id="table" style="display: -moz-groupbox;">
       <thead class="bg-success text-white">
        <tr>
          <th>@lang('Userhome.user_ans')</th>

        </tr>
       </thead>
       <tbody >
         <tr>
           <td id="show_ans" class="collapse"></td>
         </tr>
       </tbody>
   </table>
   </div>

   </div>
      </div>


</div>





    <script>
        $(document).ready(function(){
            $(document).on('click', '#live_ans', function(){
                var ques_id = $(this).attr("name");
                console.log(ques_id);
          $.ajax({
            url:"{{ route('userask.show_answer') }}",
            method:'GET',
            data:{'ques_id':ques_id},
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                console.log(typeof data);
                var html = '';
                html += '<p><strong>'+data+'</strong></p>'
                $('#show_ans').html(html);
            }
          });
            })
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

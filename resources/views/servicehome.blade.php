@extends('layouts.servicelayout')

@section('content')
<div class="container pt-3">

<div class="row">
    <div class="col-sm-6 needs-validation" novalidate>
      <div class="card">
        <div class="card-body">

          <div class="form-row pt-2 pb-2">
              <div class="pt-2 pr-2 pl-2">@lang('Serverhome.insert_category')</div>
            <div class="col-sm-4">
              <select name="categories" id="categories" class="form-control " required>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">{{ $category->category }}</option>

                @endforeach
            </select>
            </div>

          </div>
          <div class="form-group">
            <textarea class="form-control" rows="5" id="question" placeholder="@lang('Serverhome.insert_q')" onfocus="this.value=''" required></textarea>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="5" id="answer" placeholder="@lang('Serverhome.insert_a')" onfocus="this.value=''" required></textarea>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>
        <div class="pb-3"id="Sami" align="center">
        <button type="submit" class="btn btn-success">@lang('Serverhome.insert_sub')</button>
        </div>
      </div>
    </div>

    <!--DATA IMPORT/EXPORT-->
    <div class="col-6">
      <!--DATA EXPORT-->

      <!--DATA IMPORT-->
      <div class="card p-3">
        <div class="card-header">
            @lang('Serverhome.insert_data')
            @if(count($errors) > 0)
             <div class="alert alert-danger">
              Upload Validation Error<br><br>
              <ul>
               @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
              </ul>
             </div>
            @endif

            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
        <div class="form-row pt-2">
          <div class="col">
            <form method="post" enctype="multipart/form-data" action="{{ url('/servicehome/import') }}">
              {{ csrf_field() }}
              <div class="form-group">
               <table class="table">
                <tr>
                 <td width="40%" align="right"><label>@lang('Serverhome.insert_data1')</label></td>
                 <td width="30">
                  <input type="file" name="select_file" />
                 </td>
                 <td width="30%" align="left">
                  <input type="submit" name="upload" class="btn btn-success" value="@lang('Serverhome.insert_up')">
                 </td>
                </tr>
                <tr>
                 <td width="40%" align="right"></td>
                 <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                 <td width="30%" align="left"></td>
                </tr>
               </table>
              </div>
             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    $(document).ready(function(){
      $( "#Sami" ).click(function() {
      var questions = $("#question").val();
      var singleValues = $("#categories").val();
      var answers = $("#answer").val();
      console.log(questions);
      console.log(singleValues);
      //alert( "Handler for .click() called." );
      $.ajax({
        url:"{{ route('servicehome.insert_ques_ans') }}",
        method:'GET',
        data:{'questions':questions,'categories':singleValues,'answers':answers},
        dataType:'json',
        success:function(data)
        {
          alert(data);
        }
      });
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

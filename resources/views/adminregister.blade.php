@extends('layouts.adminlayout')

@section('content')

<div class="container">
<div class="row">
<div class="col-md-6">
<h4>@lang('Adminhome.User_Table')</h4>
<h5>@lang('Adminhome.Total_Users') : {{$num=count($pages)}}</h5>
    <table id="CT" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>@lang('Adminhome.User_ID')</th>
                <th>@lang('Adminhome.User_Name')</th>
                <th>@lang('Adminhome.User_Mail')</th>
                <th>@lang('Adminhome.Date_Added')</th>
                <th>@lang('Adminhome.Last_Accessed')</th>
            </tr>
        </thead>
        <tbody>
@if(count($pages)>0)
    @foreach ( $pages as $Cat )
        <div class="well">
            <tr>
                <td>{{$Cat->id}}</td>
                <td>{{$Cat->name}}</td>
                <td>{{$Cat->email}}</td>
                <td>{{$Cat->created_at}}</td>
                <td>{{$Cat->updated_at}}</td>
            </tr>
    @endforeach
@else
<p>No Categories Found</p>

@endif
</tbody>
</table>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#CT').DataTable({
                lengthChange: false,
                buttons: ['excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#CT_wrapper .col-md-6:eq(0)');
        });
    </script>
        </div>

        <div class="col-md-6">
        <h4>@lang('Adminhome.User_Create')</h4>

            {!! Form::open(['action'=>'AdminUserController@store','method'=>'User'])!!}
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Adminhome.Name')</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">@lang('Adminhome.E_Mail_Address')</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Adminhome.Password')</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('Adminhome.Confirm_Password')</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>


                <div class="row justify-content-center">
                    {{Form::submit(__('Adminhome.Add'),['class'=>'btn btn-primary'])}}

                </div>


                {!! Form::close()!!}






    </div>
    </div>
    </div>

@endsection

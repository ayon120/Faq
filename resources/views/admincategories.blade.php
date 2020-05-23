@extends('layouts.adminlayout')

@section('content')

<div class="container">
<div class="row">
<div class="col-md-6">
<h4>@lang('Adminhome.Category')</h4>
<h5>@lang('Adminhome.Total_Categories') : {{$num=count($pages)}}</h5>
    <table id="CT" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>@lang('Adminhome.ID')</th>
                <th>@lang('Adminhome.Category')</th>
                <th>@lang('Adminhome.Date_Added')</th>
                <th>@lang('Adminhome.Date_Updated')</th>
            </tr>
        </thead>
        <tbody>
@if(count($pages)>0)
    @foreach ( $pages as $Cat )
        <div class="well">
            <tr>
                <td>{{$Cat->id}}</td>
                <td>{{$Cat->category}}</td>
                <td>{{$Cat->created_at}}</td>
                <td>{{$Cat->updated_at}}</td>
            </tr>
    @endforeach
@else
<p>@lang('Adminhome.No_Categories_Found')</p>

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
                buttons: [ 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#CT_wrapper .col-md-6:eq(0)');
        });
    </script>
        </div>
        <div class="col-md-6">
        <h4>@lang('Adminhome.Category_Create')</h4>

            {!! Form::open(['action'=>'AdminCategoriesController@store','method'=>'Category'])!!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}

            </div>
                {{Form::submit(__('Adminhome.Add'),['class'=>'btn btn-primary'])}}
                {!! Form::close()!!}

        <h4>@lang('Adminhome.Category_Data_Manipulation')</h4>


            {!! Form::open(['action'=>['AdminCategoriesController@update', 4],'method'=>'Category'])!!}
            <div class="form-group">
                {{Form::label('id',__('Adminhome.Enter_ID'))}}
                {{Form::number('id','',['class'=>'form-control','placeholder'=>__('Adminhome.ID')])}}
                {{Form::label('title',__('Adminhome.Title'))}}
                {{Form::text('title','',['class'=>'form-control','placeholder'=>__('Adminhome.Title')])}}
                {{Form::label('decission',__('Adminhome.Decision'))}}
                {{Form::select('D', ['E' => __('Adminhome.Edit'), 'D' => __('Adminhome.Delete')])}}
            </div>
            {{Form::hidden('_method','PUT')}}

            {{Form::submit(__('Adminhome.Submit'),['class'=>'btn btn-primary'])}}
            {!! Form::close()!!}





    </div>
    </div>
    </div>

@endsection

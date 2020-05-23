@extends('layouts.adminlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Adminhome.Dashboard')</div>

                <div class="card-body">


                    <table class="table">
                        <thead>
                          <tr>

                            <th scope="col">@lang('Adminhome.Name')</th>
                            <th scope="col">@lang('Adminhome.E_mail')</th>
                            <th scope="col">@lang('Adminhome.Current_Role')</th>
                            <th scope="col">@lang('Adminhome.Role')</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )



                          <tr>

                            <td>{{$user->name}}</td>
                            <td>{{$user->email}} </td>
                            <td>{{$user->roles()->get()->pluck('name')}}</td>
                            <td>
                            <a href="{{route('admin.users.edit', $user->id)}}"> <button type="button" class="btn btn-primary float-left">@lang('Adminhome.Add')</button></a>


                            <form action="{{route('admin.users.destroy',$user)}}" method="post" class="float-left">
                               @csrf
                               {{method_field('delete')}}
                               <button type="submit" class="btn btn-warning ">@lang('Adminhome.Delete')</button>

                            </form>


                            </td>

                          </tr>
                          @endforeach

                        </tbody>
                      </table>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection

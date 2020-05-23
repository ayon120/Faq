@extends('layouts.servicelayout')

@section('content')

<div class="container pt-3" >

       <a href="" class="notif" style="position: relative;
       display: block;
       height: 50px;
       width: 50px;
       background: url('http://i.imgur.com/evpC48G.png');
       background-size: contain;
       text-decoration: none;">
           <span class="num" style="position: absolute;
           right: 11px;
           top: 6px;
           color: #fff;">{{count($questions)}}</span>
        </a>


        @foreach($questions as $question)

         <div class="card p-3 bg-light">

        <p><strong>@lang('Serverhome.ask_name')</strong>{{$question->name}}</p>
        <p><strong>@lang('Serverhome.ask_ques')</strong>{{$question->question}}</p>


         <form action="{{ route('giveans') }}" method="POST">
          {{ csrf_field() }}
          <label for="title">@lang('Serverhome.ask_ans')</label>

          <input type="text" name="ans" id="ans" class="form-control" />
          <input type="hidden" id="qid" name="qid" value="{{$question->id}}">
          <div class="p-2"></div>
          <input type="submit" class="btn btn-success" value="@lang('Serverhome.ask_sub')" />
        </form>

    </div>
    <div class="p-2"></div>
        @endforeach

</div>

@endsection

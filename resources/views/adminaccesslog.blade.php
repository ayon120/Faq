@extends('layouts.adminlayout')
@section('content')
<div class="container">
    <div class="col">
        @foreach ($number_blocks as $block)
        <div class="col-md-4 ">
            <div class="info-box">
                    <span class="info-box-icon bg-red"
                          style="display:flex; flex-direction: column; justify-content: center;">
                        <i class="fa fa-chart-line"></i>
                    </span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ $block['title'] }}</span>
                    <span class="info-box-number">{{ $block['number'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</br>
    <div class="row">
        @foreach ($list_blocks as $block)
            <div class="col-md-6">
                <h5>{{ $block['title'] }}</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>updated_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($block['entries'] as $entry)
                        <tr>
                            <td>{{ $entry->name }}</td>
                            <td>{{ $entry->email }}</td>
                            <td>{{ $entry->updated_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No entries found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <div class="col-md-6 ">
        <div class="container">
        <div class="row justify-content-center">
            <div class="{{ $chart1->options['column_class'] }}">
                <h5>{!! $chart1->options['chart_title'] !!}</h5>
                {!! $chart1->renderHtml() !!}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                {!! $chart1->renderJs() !!}
            </div>
        </div>
    </div>

</div>
</div>
@endsection

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminCreatelogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $number_blocks = [
            [
                'title' => 'Users Created In Today',
                'number' => User::whereDate('created_at', today())->count()
            ],
            [
                'title' => 'Users Created In Last 7 Days',
                'number' => User::whereDate('created_at', '>', today()->subDays(7))->count()
            ],
            [
                'title' => 'Users Created In Last 30 Days',
                'number' => User::whereDate('created_at', '>', today()->subDays(30))->count()
            ],
        ];

        $list_blocks = [
            [
                'title' => 'Last Created In Users',
                'entries' => User::orderBy('created_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
            [
                'title' => 'Users Not Created In For 30 Days',
                'entries' => User::where('created_at', '<', today()->subDays(30))
                    ->orwhere('created_at', null)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get()
            ],
        ];

        $chart_settings1 = [
            'chart_title'        => 'New Users By day',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_date',
            'model'              => 'App\\User',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '10',
        ];
        $chart1 = new LaravelChart($chart_settings1);

        

        return view('admincreatelogs', compact('number_blocks', 'list_blocks', 'chart1',));
    }
}

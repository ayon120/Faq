<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class AdminLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $number_blocks = [
            [
                'title' => 'Users Logged In Today',
                'number' => User::whereDate('updated_at', today())->count()
            ],
            [
                'title' => 'Users Logged In Last 7 Days',
                'number' => User::whereDate('updated_at', '>', today()->subDays(7))->count()
            ],
            [
                'title' => 'Users Logged In Last 30 Days',
                'number' => User::whereDate('updated_at', '>', today()->subDays(30))->count()
            ],
        ];

        $list_blocks = [
            [
                'title' => 'Last Logged In Users',
                'entries' => User::orderBy('updated_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
            [
                'title' => 'Users Not Logged In For 30 Days',
                'entries' => User::where('updated_at', '<', today()->subDays(30))
                    ->orwhere('updated_at', null)
                    ->orderBy('updated_at', 'desc')
                    ->take(5)
                    ->get()
            ],
        ];

        $chart_settings1 = [
            'chart_title'        => 'Users By day',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_date',
            'model'              => 'App\\User',
            'group_by_field'     => 'updated_at',
            'group_by_period'    => 'day',
            'aggregate_function' => 'count',
            'filter_field'       => 'updated_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '10',
        ];
        $chart1 = new LaravelChart($chart_settings1);

        

        return view('adminaccesslog', compact('number_blocks', 'list_blocks', 'chart1',));
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\User;
use App\Category;
use App\MainQuestion;
use DB;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class AdmingraphController extends Controller
{
    function index()
    {
        return view('admingraph');
    }

    function makeChart(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('value');
            $dbData = [];
            //dd($query);
            switch ($query) {
                case 'week':
                       $from = Carbon::now()->subWeek();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                           $range[$date->format("d-F")] = 0;
                       }
                       $title = 'Weekly Data';
                       $usersPerMonth =User::select(DB::raw('count(id) as `data`'),
                    DB::raw("DATE_FORMAT(created_at, '%d-%M') new_date"))
                    ->whereDate('created_at', '>=', date($from).' 00:00:00')
                    ->whereDate('created_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;

                case 'month':
                       $from = Carbon::now()->subMonth();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                           $range[$date->format("d-F")] = 0;
                       }
                       $title = 'Monthly Data';
                       $usersPerMonth =User::select(DB::raw('count(id) as `data`'),
                    DB::raw("DATE_FORMAT(created_at, '%d-%M') new_date"))
                    ->whereDate('created_at', '>=', date($from).' 00:00:00')
                    ->whereDate('created_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;

                case 'year':
                       $from = Carbon::now()->subYear();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1M'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                           $range[$date->format("F-Y")] = 0;
                       }

                       $title = 'Yearly Data';
                       $usersPerMonth =User::select(DB::raw('count(id) as `data`'),
                    DB::raw("DATE_FORMAT(created_at, '%M-%Y') new_date"))
                    ->whereDate('created_at', '>=', date($from).' 00:00:00')
                    ->whereDate('created_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;


                default:
            }


                    //dd($usersPerMonth);

          foreach($usersPerMonth as $val){
            $dbData[$val->new_date] = $val->data;
          }
          //dd($dbData);

          $dataAyon = array_replace($range, $dbData);
          //dd($dataAyon);
          $category = array_keys($dataAyon);
          $doc = array_values($dataAyon);
          $type = 'column';
          $a = array('category'=>$category,
          'doc'=>$doc,
          'type'=>$type,
          'title'=>$title);

            //return view('admingraph', compact('chart'));
            echo json_encode($a);

    //echo json_encode($output);
        }
    }


    function makeHitCountChart(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('value');
            $dbData = [];
            //dd($query);
            switch ($query) {
                case 'week':
                       $from = Carbon::now()->subWeek();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       $title = 'Weekly Data';

                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->join('categories', 'main_questions.category_id', '=', 'categories.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('categories.category as category'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('category')
                    ->get();
                    break;

                case 'month':
                       $from = Carbon::now()->subMonth();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       $title = 'Monthly Data';
                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->join('categories', 'main_questions.category_id', '=', 'categories.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('categories.category as category'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('category')
                    ->get();
                    break;

                case 'year':
                       $from = Carbon::now()->subYear();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1M'), new DateTime($to));
                       //dd($period);
                       $dbData = [];


                       $title = 'Yearly Data';
                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->join('categories', 'main_questions.category_id', '=', 'categories.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('categories.category as category'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('category')
                    ->get();
                    break;


                default:
            }


                    //dd($usersPerMonth);

          foreach($usersPerMonth as $val){
            $dbData[$val->category] = $val->data;
          }
          //dd($dbData);
          //dd($dataAyon);
          $category = array_keys($dbData);
          $doc = array_values($dbData);
          $type = 'pie';
          $a = array('category'=>$category,
          'doc'=>$doc,
          'type'=>$type,
          'title'=>$title);

            echo json_encode($a);

        }
    }


    function makequesCountChart(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('value');
            $dbData = [];
            switch ($query) {
                case 'week':
                       $from = Carbon::now()->subWeek();
                       $to = Carbon::now();

                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));

                       $dbData = [];

                       $title = 'Weekly Data';

                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('main_questions.question as question'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('question')
                    ->orderBy('data','desc')
                    ->skip(0)->take(10)
                    ->get();
                    break;

                case 'month':
                       $from = Carbon::now()->subMonth();
                       $to = Carbon::now();

                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));

                       $dbData = [];

                       $title = 'Monthly Data';
                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('main_questions.question as question'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('question')
                    ->orderBy('data','desc')
                    ->skip(0)->take(10)
                    ->get();
                    break;

                case 'year':
                       $from = Carbon::now()->subYear();
                       $to = Carbon::now();

                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1M'), new DateTime($to));

                       $dbData = [];


                       $title = 'Yearly Data';
                       $usersPerMonth = DB::table('ques_hit_count_stats')
                       ->join('main_questions', 'ques_hit_count_stats.question_id', '=', 'main_questions.id')
                       ->select(DB::raw('count(ques_hit_count_stats.question_id) as `data`'),
                    DB::raw('main_questions.question as question'))
                    ->whereDate('ques_hit_count_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('ques_hit_count_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('question')
                    ->orderBy('data','desc')
                    ->skip(0)->take(10)
                    ->get();
                    break;


                default:
            }


          foreach($usersPerMonth as $val){
            $dbData[$val->question] = $val->data;
          }
          $question = array_keys($dbData);
          $doc = array_values($dbData);
          $type = 'bar';
          $a = array('category'=>$question,
          'doc'=>$doc,
          'type'=>$type,
          'title'=>$title);

            echo json_encode($a);
        }
    }




    function accessChart(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('value');
            $dbData = [];
            //dd($query);
            switch ($query) {
                case 'week':
                       $from = Carbon::now()->subWeek();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                        $range[$date->format("d-F")] = 0;
                    }
                       $title = 'Weekly Data';

                       $usersPerMonth = DB::table('access_stats')
                       ->join('users', 'access_stats.user_id', '=', 'users.id')
                       ->select(DB::raw('count(access_stats.user_id) as `data`'),
                    DB::raw("DATE_FORMAT(access_stats.updated_at, '%d-%M') new_date"))
                    ->whereDate('access_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('access_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;

                case 'month':
                       $from = Carbon::now()->subMonth();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1D'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                        $range[$date->format("d-F")] = 0;
                    }
                       $title = 'Monthly Data';
                       
                       $usersPerMonth = DB::table('access_stats')
                       ->join('users', 'access_stats.user_id', '=', 'users.id')
                       ->select(DB::raw('count(access_stats.user_id) as `data`'),
                    DB::raw("DATE_FORMAT(access_stats.updated_at, '%d-%M') new_date"))
                    ->whereDate('access_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('access_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;

                case 'year':
                       $from = Carbon::now()->subYear();
                       $to = Carbon::now();
                       //dd($from);
                       $period = new DatePeriod( new DateTime($from), new DateInterval('P1M'), new DateTime($to));
                       //dd($period);
                       $dbData = [];

                       foreach($period as $date){
                        $range[$date->format("F-Y")] = 0;
                    }
                       $title = 'Yearly Data';
                       
                       $usersPerMonth = DB::table('access_stats')
                       ->join('users', 'access_stats.user_id', '=', 'users.id')
                       ->select(DB::raw('count(access_stats.user_id) as `data`'),
                    DB::raw("DATE_FORMAT(access_stats.updated_at, '%M-%Y') new_date"))
                    ->whereDate('access_stats.updated_at', '>=', date($from).' 00:00:00')
                    ->whereDate('access_stats.updated_at', '<=', date($to).' 00:00:00')
                    ->groupBy('new_date')
                    ->get();
                    break;


                default:
            }


                    //dd($usersPerMonth);

          foreach($usersPerMonth as $val){
            $dbData[$val->new_date] = $val->data;
          }
          $dataAyon = array_replace($range, $dbData);
          //dd($dataAyon);
          $category = array_keys($dataAyon);
          $doc = array_values($dataAyon);
          $type = 'column';
          $a = array('category'=>$category,
          'doc'=>$doc,
          'type'=>$type,
          'title'=>$title);

            echo json_encode($a);

        }
    }


}

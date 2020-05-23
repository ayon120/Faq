<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Category;
use App\MainQuestion;
use App\Answer;

class ServiceqaLiveTableController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $categories = Category::all();
        return view('serviceqalivetable', compact('categories'));
    }

    function action(Request $request)
    {
        if($request->ajax())
     {
      $query = $request->get('query');
      $categories = $request->get('categories');
      if($query != '' && (int)$categories!=0)
      {
       $data = MainQuestion::where('category_id',((int)$categories))->where('question', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();

      }
      elseif((int)$categories!=0 && $query == '')
      {
        $data = MainQuestion::where('category_id',((int)$categories))
        ->orderBy('id', 'desc')
        ->get();
      }
      elseif($query != '')
      {
        $data = MainQuestion::where('question', 'like', '%'.$query.'%')
        ->orderBy('id', 'desc')
        ->get();
      }
      else
      {
       $data = MainQuestion::orderBy('id', 'desc')
         ->get();
      }

      $total_row = $data->count();
      $alldata = MainQuestion::orderBy('id', 'desc')->get();
      $total_ques = $alldata->count();

      $t_data = array(
       'table_data'  => $data,
       'total_data'  => $total_row.('/').strval($total_ques)
      );

      echo json_encode($t_data);
     }
    }
    function answer_action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $ques_id = $request->get('ques_id');
            $data = Answer::where('question_id',(int)$ques_id)
            ->orderBy('id', 'desc')->get();
            echo json_encode($data);
        }
    }

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name   =>  $request->column_value
            );
            MainQuestion::where('id', $request->id)->update($data);
            echo '<div class="alert alert-success">Question Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            MainQuestion::where('id', $request->id)->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }

    function ans_delete_data(Request $request)
    {
        if($request->ajax())
        {
            Answer::where('id', $request->id)->delete();
            echo '<div class="alert alert-success">Answer Deleted</div>';
        }
    }

    function ans_update_data(Request $request)
    {
      if($request->ajax())
      {
          $data = array(
              $request->column_name   =>  $request->column_value
          );
          Answer::where('id', $request->id)->update($data);
          echo '<div class="alert alert-success">Answer Updated</div>';
      }
    }

    function ans_add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'question_id'    =>  (int)$request->ques_id,
                'answer'    =>  $request->answer
            );
            $id = Answer::insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        }
    }
}

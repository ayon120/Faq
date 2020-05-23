<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Category;
use App\MainQuestion;
use App\Answer;

class UserhomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $categories = Category::all();
        return view('userhome', compact('categories'));
    }

    function action(Request $request)
    {
        if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      $categories = $request->get('categories');
      if($query != '' && (int)$categories!=0)
      {
        //var_dump($query);
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
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td id ='.strval($row->id).'>'.$row->question.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row.('/').strval($total_ques)
      );

      echo json_encode($data);
     }
    }
    function answer_action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $ques_id = $request->get('ques_id');
            MainQuestion::where('id', $ques_id)->update([
                'updated_at' => now()
                ]);
            DB::table('ques_hit_count_stats')->insert(array('question_id'=>$ques_id,"updated_at"=>Carbon::now()));
            $data = Answer::where('question_id',(int)$ques_id)
            ->orderBy('id', 'desc')->get();
            foreach($data as $ans)
            {
            $output .= '<tr><td>'.$ans->answer.'</tr></td>';
            }
            $data = $output;
            echo json_encode($data);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Category;
use App\MainQuestion;
use App\Answer;


class ServicehomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('servicehome', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function insert_ques_ans(Request $request)
    {
        if($request->ajax())
        {
            $this->validate($request, [
                'categories'  => 'required',
                'questions'  => 'required',
                'answers' => 'required'
               ]);
            $questions = $request->get('questions');
            $categories = $request->get('categories');
            $answers = $request->get('answers');

            $ques_id = MainQuestion::insertGetId(
                ['category_id' => (int)$categories, 'question' => $questions]
            );
            $ans_id = Answer::insertGetId(
                ['question_id' => $ques_id, 'answer' => $answers]
            );
            $data = "Data has been inserted";
            echo json_encode($data);
            //return back()->with('success', 'Excel Data Imported successfully.');

        }
    }
    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required'
     ]);

     $path = $request->file('select_file')->getRealPath();
     $extention = $request->file('select_file')->getClientOriginalExtension();

     if('xls' == $extention) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($path)->getActiveSheet();
    //dd($spreadsheet);
    $insert_data = $spreadsheet->toArray();
    //dd($a);
      /*foreach($a as $key => $value)
      {//dd($key);
        dd($value);
       foreach($value as $row)
       {
           //dd($row);
        $insert_data[] = array(
         'category'=> $row[0],
         'question'=> $row[1],
         'answer'=> $row[2]
        );
       }
      }*/
      array_shift($insert_data);
      if(!empty($insert_data))
      {
        foreach($insert_data as $i_data)
        {
            $datas = Category::where('category',$i_data[0])->get();
            foreach($datas as $data)
            {
                $id=$data->id;
                //dd($id);
            }
            //$a = $data->map->only(['id']);
            //dd($a[0]['id']);
            $ques_id = MainQuestion::insertGetId(
            ['category_id' => $id, 'question' => $i_data[1]]);
            $ans_id = Answer::insertGetId(
                ['question_id' => $ques_id, 'answer' => $i_data[2]]
            );
        }
      }
     return back()->with('success', 'Excel Data Imported successfully.');
    }
}

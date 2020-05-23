<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\liveanswer;
use App\livequestion;
use DB;
use Illuminate\Support\Facades\Auth;

class UseraskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index( )
    {
        $id=Auth::user()->id;
        $questions=DB::table('livequestions')
        ->where('user_id', $id)
        ->orderBy('id','desc')
        ->get();

        return view('userask')-> with('questions', $questions) ;
        
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
        $id=Auth::user()->id;
        $this->validate($request,['ques'=>'required'] );

        $question= new livequestion();

        $question->question=$request->ques;
        $question->user_id=$id;
        $question->status=0;
        
        if($question->save())
        {

            //return redirect()->route('questions.show',$question->id);
            return redirect()->route('userask');

        }
        else
        {
            return redirect()->route('userask');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $question=livequestion::findOrFail($id);

        //return redirect()->route('questions.show');
        
        return view ('showans')->with('question',$question);



       // $answers=DB::table('livequestions')
        //->join('liveanswers','liveanswers.livequestion_id','livequestions.id')
      //  ->select('liveanswers.*')
     //   ->where('livequestions.id',$id)->get();

       // return view ('showans')->with('answers',$answers);
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

    public function show_answer(Request $request)
    {
        if($request->ajax())
        {
            $ques_id = $request->get('ques_id');
            $question=livequestion::findOrFail($ques_id);
            if($question->answers->count()>0)
            {
                foreach($question->answers as $ans){
                    $live_ans = $ans->answer;
                }
                echo json_encode($live_ans);
            }
            else{
                echo json_encode("Please wait. We will get back to you.");
            }
        }
    }
}

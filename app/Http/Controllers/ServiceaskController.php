<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\liveanswer;
use App\livequestion;
use DB;
use Illuminate\Support\Facades\Auth;

class ServiceaskController extends Controller
{

    public function showAllQuestions(){

        $questions=DB::table('livequestions')
        ->join('users', 'livequestions.user_id', '=', 'users.id')

        ->select('users.name', 'users.email', 'livequestions.question', 'livequestions.status','livequestions.id')
        ->where('livequestions.status', '=', 0)
        ->get();


        return view ('serviceask')->with('questions',$questions);



     }


         public function storeAnswer(Request $request)
         {

             $this->validate($request,['ans'=>'required'] );

         $question= new livequestion();
         $answer= new liveanswer();


         $answer->answer=$request->ans;
         $answer->livequestion_id=$request->qid;

         $question=livequestion::findOrFail($request->qid);
         $question->status = 1;


         if($answer->save())
         {

             //return redirect()->route('questions.show',$question->id);


 // Make sure you've got the Page model
      if($question->save()) {



             return redirect()->route('serviceask');
      }

         }
         else
         {
             return redirect()->route('serviceask');


         }

    }
}

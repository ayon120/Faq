<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
class AdminAnswerController extends Controller
{
    public function index()
    {
        $Answers=Answer::all();             
        return view('answers_ranking')->with('pages',$Answers);
    }

}

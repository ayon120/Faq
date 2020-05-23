<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //return Category::all();
        $catagories=Category::all();
        return view('admincategories')->with('pages',$catagories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $catagories=Category::all();
        $num=Category::count();
        return view('admincategories')->with('cats', $catagories)->with('num', $num);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
        ]);
        //Create Category
        $cat=new Category;
        $cat->category=$request->input('title');
        $cat->save();
        return redirect('/admincategories')->with('success','Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catagories=Category::find($id);
        $num=Category::count();
        return view('admincategories')->with('cats', $catagories)->with('num', $num);
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
        $this->validate($request,[
            'title'=>'required',
            'id'=>'required',
            'D'=>'required'
        ]);

        $E='E';

        //Create Category
        if($request->input('D')==$E)

        {
        $cat=Category::find($request->input('id'));
        $cat->category=$request->input('title');
        $cat->save();
        return redirect('/admincategories')->with('success','Category Edited');
    }else{
        $cat=Category::find($request->input('id'));
        $cat->delete();
        return redirect('/admincategories')->with('success','Category Deleted');

    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Category::find($id);
        $cat->delete();
        return redirect('/admincategories')->with('success','Category Deleted');
    }
}

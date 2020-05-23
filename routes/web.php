<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use Illuminate\Routing\Route;



Route::get('locale/{locale}', function($locale){

    Session::put('locale',$locale);

    return redirect()->back();

} );

Route::get('/', function () {
    if(Auth::check()) {
        if(Auth::user()->hasRole('admin'))
               return redirect('/admin/users');

        if(Auth::user()->hasRole('manager'))
               return redirect('/servicehome');

        if(Auth::user()->hasRole('generic'))
               return redirect('/userhome');
    } else {
        return view('auth.login');
    }
});



  Auth::routes();




Route::get('/userhome', 'UserhomeController@index')->name('userhome');
Route::get('/userhome/action', 'UserhomeController@action')->name('userhome.action');
Route::get('/userhome/answer_action', 'UserhomeController@answer_action')->name('userhome.answer_action');

Route::get('/userask', 'UseraskController@index')->name('userask');
Route::post('/userask', 'UseraskController@store')->name('useraskques');
//Route::get('/livequestion', 'LiveQuestionsController@show')->name('showques');
Route::get('/userask/show_answer', 'UseraskController@show_answer')->name('userask.show_answer');

Route::get('/usernotice', 'UsernoticeController@index');

Route::get('/servicehome', 'ServicehomeController@index')->middleware('can:provide-service');
Route::get('/servicenotice', 'ServicenoticeController@index')->middleware('can:provide-service');
Route::get('/servicehome/insert_ques_ans', 'ServicehomeController@insert_ques_ans')->name('servicehome.insert_ques_ans')->middleware('can:provide-service');
Route::post('/servicehome/import', 'ServicehomeController@import')->middleware('can:provide-service');

Route::get('/serviceqalivetable', 'ServiceqaLiveTableController@index')->name('serviceqalivetable')->middleware('can:provide-service');
Route::get('/serviceqalivetable/action', 'ServiceqaLiveTableController@action')->name('serviceqalivetable.action')->middleware('can:provide-service');
Route::post('/serviceqalivetable/update_data', 'ServiceqaLiveTableController@update_data')->name('serviceqalivetable.update_data')->middleware('can:provide-service');
Route::post('/serviceqalivetable/delete_data', 'ServiceqaLiveTableController@delete_data')->name('serviceqalivetable.delete_data')->middleware('can:provide-service');
Route::get('/serviceqalivetable/answer_action', 'ServiceqaLiveTableController@answer_action')->name('serviceqalivetable.answer_action')->middleware('can:provide-service');
Route::post('/serviceqalivetable/ans_update_data', 'ServiceqaLiveTableController@ans_update_data')->name('serviceqalivetable.ans_update_data')->middleware('can:provide-service');
Route::post('/serviceqalivetable/ans_delete_data', 'ServiceqaLiveTableController@ans_delete_data')->name('serviceqalivetable.ans_delete_data')->middleware('can:provide-service');
Route::post('/serviceqalivetable/ans_add_data', 'ServiceqaLiveTableController@ans_add_data')->name('serviceqalivetable.ans_add_data')->middleware('can:provide-service');

Route::get('/serviceask', 'ServiceaskController@showAllQuestions')->name('serviceask')->middleware('can:provide-service');
Route::post('/serviceask/storeAnswer', 'ServiceaskController@storeAnswer')->name('giveans')->middleware('can:provide-service');

Route::post('/servicenoticestore', 'ServicenoticeController@store')->middleware('can:provide-service');
Route::get('/servicenotice/fetch_data', 'ServicenoticeController@fetch_data')->middleware('can:provide-service');
Route::post('/servicenotice/update_data', 'ServicenoticeController@update_data')->name('servicenotice.update_data')->middleware('can:provide-service');
Route::post('/servicenotice/delete_data', 'ServicenoticeController@delete_data')->name('servicenotice.delete_data')->middleware('can:provide-service');


//Route::namespace('Admin')->prefix('admin')->name->('admin.')->group(function(){

    //Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);

//});

Route::group(['namespace' => 'Admin','prefix' => 'admin', 'as' => 'admin.', 'middleware'=>'can:manage-users'], function () {

    Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);

});

Route::resource('/admincategories','AdminCategoriesController')->middleware('can:manage-users');
Route::resource('/adminregister','AdminUserController')->middleware('can:manage-users');
Route::get('/adminregister','AdminUserController@index')->middleware('can:manage-users');
Route::get('/logs','AdminLogsController@index')->middleware('can:manage-users');
Route::get('/admincreatelogs','AdminCreatelogController@index')->middleware('can:manage-users');
Route::get('/questions_ranking','AdminQuestionController@index')->middleware('can:manage-users');
Route::get('/answers_ranking','AdminAnswerController@index')->middleware('can:manage-users');
Route::get('/admingraph','AdmingraphController@index')->name('admingraph')->middleware('can:manage-users');
Route::get('/admingraph/makechart','AdmingraphController@makeChart')->name('chart.makebarchart')->middleware('can:manage-users');
Route::get('/admingraph/makehitcountchart','AdmingraphController@makeHitCountChart')->name('chart.makehitcountchart')->middleware('can:manage-users');
Route::get('/admingraph/makequeschart','AdmingraphController@makequesCountChart')->name('chart.makequeschart')->middleware('can:manage-users');
Route::get('/admingraph/accesschart','AdmingraphController@accessChart')->name('chart.accesschart')->middleware('can:manage-users');

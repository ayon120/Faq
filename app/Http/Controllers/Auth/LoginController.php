<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;
use App\User;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


public function redirectTo(){

if(Auth::user()->hasRole('admin')){
    $user = Auth::user();
   // $user->updated_at=Carbon::now();
    $this->redirectTo=route('admin.users.index');

    return $this->redirectTo;


}


if(Auth::user()->hasRole('manager')){
    $id=Auth::user()->id;
    DB::table('users')
    ->where('id', $id)
    ->update(['updated_at' => now()]);

   // $user->updated_at=Carbon::now();
    $this->redirectTo='/servicehome';

    return $this->redirectTo;


}

if(Auth::user()->hasRole('generic')){
    $id=Auth::user()->id;
    DB::table('users')
    ->where('id', $id)
    ->update(['updated_at' => now()]);

   // $user->updated_at=Carbon::now();
    $this->redirectTo='/userhome';

    return $this->redirectTo;


}


}



}


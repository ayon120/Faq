<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use \Carbon\Carbon;
class AdminLoginUpdator extends Controller
{
    public function updateProfile(Request $request)
    {
        $user=$request->user();
        $user->updated_at=Carbon::now();
    }
}

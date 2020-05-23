<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class livequestion extends Model
{
    public function answers (){

        return $this->hasMany('App\liveanswer');

    }
}

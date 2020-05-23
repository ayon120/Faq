<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class liveanswer extends Model
{
    public function questions ()
    {
        return $this->belongsTo('App\livequestion');


    }
}

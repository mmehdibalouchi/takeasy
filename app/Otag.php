<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otag extends Model
{
    //

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function questions()
    {
    	return $this->belongsToMany('App\Question', 'qtags_questions', 'qtag_id', 'question_id')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pquestion extends Model
{
    protected $table = 'private_questions';
    protected $fillable = ['qowner_id', 'aowner_id', 'content'];

    public function answers()
    {
    	return $this->morphMany('App\Answer', 'answerable');
    }
}

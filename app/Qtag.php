<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qtag extends Model
{
    protected $fillable = ['name'];


    public function interestsUsers()
    {
        return $this->belongsToMany('App\User', 'user_interests', 'qtag_id', 'user_id');
    }

    public function professionalsUsers()
    {
        return $this->belongToMany('App\User', 'user_professionals', 'qtag_id', 'user_id');
    }
}

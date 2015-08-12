<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    // protected $fillable = ['content', 'question_id', 'user_id'];
    protected $fillable = ['content', 'answerable_type', 'answerable_id', 'user_id'];

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    // public function question()
    // {
    //     return $this->belongsTo('App\Question');
    // }\

    public function answerable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

        public function likesNumber()
    {
        return $this->likes()->count();
    }

    public function isLiked($user_id,$string)
    {
        if(Like::where('likeable_type', 'App\Answer')->where('likeable_id', $this->attributes['id'])->where('user_id', $user_id)->count())
            return $string ? "Liked" : true;
        return $string ? "Like" : false;
    }

    public function uploadFile()
    {
        return $this->morphOne('App\Upload', 'uploadable');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    protected $fillable = ['title', 'content', 'anonymous', 'isUrgent'];

    // protected $with = ['answers', 'comments', 'likes'];

    // protected $visible = ['title', 'content', 'anonymous', 'isUrgent'];

    // protected $appends = ['answers'];

    public function getAnonymousAttribute($value)
    {
        if($value)
            return 'anonymous';
        else
            return null;
    }

    public function getIsUrgentAttribute($value)
    {
        if($value)
            return 'Urgent';
        else
            return null;

    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // public function answers()
    // {
    //     return $this->hasMany('App\Answer');
    // }

    public function answers()
    {
        return $this->morphMany('App\Answer', 'answerable');
    }

    public function qtags()
    {
        return $this->belongsToMany('App\Qtag', 'qtags_questions', 'question_id', 'qtag_id')->withTimestamps();
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
        if(Like::where('likeable_type', 'App\Question')->where('likeable_id', $this->attributes['id'])->where('user_id', $user_id)->count())
            return $string ? "Liked" : true;
        return $string ? "Like" : false;
    }

    public function uploadFile()
    {
        return $this->morphOne('App\Upload', 'uploadable');
    }
}

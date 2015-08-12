<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'likeable_type', 'likeable_id'];

    public function likeable()
    {
    	return $this->morphTo();
    }

    //likebale is array likeable[0] = 'likeable(type)' likeable[1] = likeable_id
    //true if $user_id has liked $likable
    public function isUserLiked($user_id, array $likeable)
    {
    	if(Like::where($likeable[0].'_id',$likeable[1])->where('user_id', $user_id))
    		return true;
    	return flase;
    }

    // public function isLikeableLiked($likeable_type, $likeable_id, $user_id, $string)
    // {
    //     if(Like::where('likeable_type', $likeable_type)->where('likeable_id', $likeable_id)->where('user_id', $user_id)->count())
    //         return $string ? "Liked" : true;
    //     return $string ? "Like" : false;
    // }
}

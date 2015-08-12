<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'middlename', 'family', 'gender', 'status', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function getGenderAttribute($value)
    {
        if($value)
            return 'Male';
        else
            return 'Female';
    }

    public function getStatusAttribute($value)
    {
        if($value)
            return 'Married';
        else
            return 'Single';
    }

    // public function professionalsQuestion()
    // {

    //     // return \DB::table('questions')->join('qtags_questions', 'questions.id', '=', 'qtags_questions.question_id')->whereIn('qtag_id',$this->professionals()->lists('id'))->get();
    //     $tag_ids = $this->professionals()->lists('id');
    //     $relatedQuestions = Question::whereHas('qtags', function($q) use ($tag_ids) {
    //         $q->whereIn('id', $tag_ids);
    //     })->latest()->get();
    //     return $relatedQuestions;
    // }

    public function interestsQuestion()
    {
        $tag_ids = $this->interests()->lists('id');
        $relatedQuestions = Question::whereHas('qtags', function($q) use ($tag_ids) {
            $q->whereIn('id', $tag_ids);
        })->orderBy('created_at')->get();
        return $relatedQuestions;
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Qtag', 'users_interests', 'user_id', 'qtag_id')->withTimestamps();
    }

    // public function professionals()
    // {
    //     return $this->belongsToMany('App\Qtag', 'users_professionals', 'user_id', 'qtag_id')->withTimestamps();
    // }

    public function occupations()
    {
        return $this->belongsToMany('App\Otag');
    }

    public function educations()
    {
        return $this->belongsToMany('App\Etag');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function answeredQuestions()
    {
        return $this->hasManyThrough('App\Question', 'App\Answer');
        //or
        //return $this->answers->question;
    }

    public function photo()
    {
        return $this->morphOne('App\Upload', 'uploadable');
    }

    // public function shouldSelectProTag($tag)
    // {
    //     $taglists = $this->professionals()->lists('id')->toArray();

    //     if(in_array($tag, $taglists))
    //         return 'selected';

    //     else
    //         return null;
    // }

    public function shouldSelectInterestsTag($tag)
    {
        $taglists = $this->interests()->lists('id')->toArray();

        if(in_array($tag, $taglists))
            return 'selected';

        else
            return null;
    }

    public function avatarImg($width, $height)
    {
        $address = '/avatars/anonymous.png';

        // if($this->photo->filename)
        //     $address = 'avatars/'.$this->photo->filename;

        return  '<img style="width:'.$width.'px;height:'.$height.'px" src="'.$address.'" />';
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function Elevel()
    {
        return $this->belongsTo('App\Elevel');
    }

    public function Olevel()
    {
        return $this->belongsTo('App\Olevel');
    }

    public function role()
    {
        return $this->belogsTo('App\Role');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->withTimestamps();
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
    }
 
    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }
        
}

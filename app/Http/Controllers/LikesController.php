<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Like;
use App\Question;
use App\Answer;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request ,$likeable_id)
    {
        // $this->validate($request, ['likeable_type' => 'required', 'likeable_id' => 'required']);
        
        $data = [
        'likeable_type' => 'App\\'.ucfirst($request->segment(1)),
         'likeable_id' => intval($likeable_id)
         ];
         
        $like = Like::where('likeable_type', $data['likeable_type'])->where('likeable_id', $data['likeable_id']);
        $like_num = $like->get()->count();
        $like = $like->where('user_id', \Auth::user()->id)->get();
        // dd(sizeof($like));
        $isLiked = true;

        //checking if one user has liked this likeable before
        if(!sizeof($like))
        {
            $like_num++;
            \Auth::user()->likes()->create($data);
            //chechking for user score
            if($data['likeable_type'] == 'App\Question')
            {
                $user = Question::find($data['likeable_id'])->user;
                $user->score++;
                $user->save();
            }
            //chechking for user score
            else if($data['likeable_type'] == 'App\Answer')
            {
                $addScore = 1;
                $answer = Answer::find($data['likeable_id']);
                // dd($answer->question());
                if($answer->question->user->id == \Auth::user()->id)
                    $addScore = 2;
                $user = $answer->user;
                // dd($user);
                $user->score+= $addScore;
                $user->save();
            }
        }
        //should reduce score for unlike 
        else
        {
            $isLiked = false;
            foreach($like as $l)
            {
                $l->delete();
                $like_num--;
            }

        }
        return response()->json([$isLiked, $like_num]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

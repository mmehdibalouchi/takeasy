<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Http\Requests;
use App\Http\Requests\AnswerRequest;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
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
    public function store(AnswerRequest $request, $answerable_id)
    {
        $answer = $this->createAnswer($request, $answerable_id);

        $this->addUserScore(3);

        $response = $this->answerAjaxResponse($answer);

        return response()->json($response);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(AnswerRequest $request, $id)
    {
        
        $answer = Answer::find($id);
        $answer->content = $request->input('content');
        $answer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Answer::find($id)->delete();
    }

    private function createAnswer(AnswerRequest $request, $answerable_id)
    {
        //answerable_type = 'App\Question or 'App\Pquestion'

        $data = ['content' => $request->input('content'), 'answerable_type' => 'App\\'.ucfirst($request->segment(1)),'answerable_id' => intval($answerable_id)];

        $answer = Auth::user()->answers()->create($data);

        if($request->hasFile('upload_file'))
        {
            dd('hii');
            $file = $request->file('upload_file');
            $this->saveQuestionUpload($file, $answer);
        }

        return $answer;
    }

    private function addUserScore($score)
    {
        Auth::user()->score += $score;
        Auth::user()->save();
    }

    private function saveAnswerUpload($file, $answer)
    {
        $extension = $file->getClientOriginalExtension();
        $file->move('answer-files', $file->getFilename().'.'.$extension);
        $name = $file->getFilename().'.'.$extension;
        $mime = $file->getClientMimeType();
        $original = $file->getClientOriginalName();

        $answer->uploadFile()->create([
            'filename' => $name,
            'type' => 'ANSWER_FILE',
            'mime' => $mime,
            'original_filename' => $original
            ]);

    }

    private function answerAjaxResponse($answer)
    {
                $responseString = '<div style="background-color:#B7CECC" class="jumbotron">
            <div style="background-color:white" class="jumbotron">
            '.Auth::user()->avatarImg(40,40).'
           <span style="font-size:20px" class="label label-info">'.Auth::user()->name.' '.Auth::user()->family.' at '.date("Y-m-d H:i:s").'</span><br>
          '.$answer->content.'
            </div>
            <form class="like-class" id="answer'.$answer->id.'">
            '.csrf_field().'
            <input type="hidden" name="likeable_type" value="App\Answer">
            <input type="hidden" name="likeable_id" value="'.$answer->id.'">
            <input type="submit" name="submit-btn" style="display:inline" class="btn btn-primary" value="'.$answer->isLiked(\Auth::user()->id,true).'" onclick ="return likeAjaxHandler(this.form.id)">
            <span id="like-num answer'.$answer->id.'" class="label label-warning" name="like-number" style="display:inline">'.$answer->likesNumber().'</span>
           </form>

           <div class="comments">

                    <!-- NEW COMMENT PART -->
    <div class="new_comment">
        <br>
        <span style="font-size:18px" class="label label-success">Comments</span>
        <br>

        <form id="comment-answer'.$answer->id.'" autocomplete="off">
            '.csrf_field().'
            <input class="form-control" id="new-comment" type="text" name="content" onkeydown="commentAjaxHandler(event, this.form.id)">
            <input type="hidden" name="commentable_type" value="answer">
            <input type="hidden" name="commentable_id" value="'.$answer->id.'">
        </form>

    </div>
                    <!-- ALL COMMENT PART -->
    <div id="comment-'.'answer'.$answer->id.'-list" style="background-color:"class="show-comments well">
    </div>
</div>


           </div>
           <br>';
        return $responseString;
    }

}
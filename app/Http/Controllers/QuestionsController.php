<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;
use App\Qtag;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $myQuestions = \Auth::user()->professionalsQuestion()->first();

        dd($myQuestions->with('answers')->first());
        
        return $myQuestions->toJson();          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $qtags = Qtag::lists('name', 'id');

        return view('questions.create',compact('qtags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(QuestionRequest $request)
    {

        $this->createQuestion($request);
        $this->addUserScore(3);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $question = Question::find($id);

        return view('questions.show',compact('question'));
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
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id);
        $this->updateQuestion($request, $question);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();
    }

/**
 * private functions 
 */

    private function syncQtags(Question $question, array $qtags)
    {
        $question->qtags()->sync($qtags);
    }

    private function createQuestion(QuestionRequest $request)
    {
        $question = \Auth::user()->questions()->create($request->all());
        $this->syncQtags($question, $request->input('qtags'));

        if($request->hasFile('upload_file'))
        {
            $file = $request->file('upload_file');
            $this->saveQuestionUpload($file, $question);
        }

        return $question;
    }

    private function addUserScore($score)
    {
        \Auth::user()->score += $score;
        \Auth::user()->save();
    }

    private function updateQuestion(QuestionRequest $request, $question)
    {
        $question->title = $request->input('title');
        $question->content = $request->input('content');
        $question->anonymouse = $request->input('anonymouse', false);
        $question->isUrgent = $request->input('isUrgent', false);
        $question->save();
        
        $this->syncQtags($question, $request->input('qtags'));

        return $question;
    }

    private function saveQuestionUpload($file, $question)
    {
        $extension = $file->getClientOriginalExtension();
        $file->move('question-files', $file->getFilename().'.'.$extension);
        $name = $file->getFilename().'.'.$extension;
        $mime = $file->getClientMimeType();
        $original = $file->getClientOriginalName();

        $question->uploadFile()->create([
            'filename' => $name,
            'type' => 'QUESTION_FILE',
            'mime' => $mime,
            'original_filename' => $original
            ]);

    }
}

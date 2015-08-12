<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $req)
    {
        dd($req->url());
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
    public function store(CommentRequest $request, $commentable_id)
    {
        $comment = $this->createComment($request, $commentable_id);
        $response = $this->commentAjaxResponse($comment);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::find($id);
        $comment->content = $request->input('content');
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Comment::find($id)->delete();
    }

    private function createComment(CommentRequest $request, $commentable_id)
    {
        $data = ['content' => $request->input('content'),
        'commentable_type' => 'App\\'.ucfirst($request->segment(1)),
        'commentable_id' => intval($commentable_id)];

        return \Auth::user()->comments()->create($data);
    }

    private function commentAjaxResponse($comment)
    {
        $response = '<p style="font-size:12px">'.\Auth::user()->name.': '.$comment->content;
        return $response;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qtag;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
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
    
    public function getIndex()
    {
        $qtags = Qtag::lists('name', 'id');
        return view('profile.index',compact('qtags'));
    }

    public function getShow($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function postSyncInterests(Request $request)
    {
        \Auth::user()->interests()->sync((array) $request->input('itags'));
        return redirect('/profile');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Photo;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            // 'middlename' => 'required|max:255',
            'family' => 'required|max:255',
            // 'gender' => 'required',
            // 'status' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            // 'avatar' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    //save the avatar of a usert
    protected function saveAvatar($file)
    {
        $extension = $file->getClientOriginalExtension();
        $file->move('avatars', $file->getFilename().'.'.$extension);
        $name = $file->getFilename().'.'.$extension;
        $mime = $file->getClientMimeType();
        $original = $file->getClientOriginalName();

        \Auth::user()->photo()->create([
            'filename' => $name,
            'type' => 'AVATAR',
            'mime' => $mime,
            'original_filename' => $original
            ]);

    }

    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            // 'middlename' => $data['middlename'],
            'family' => $data['family'],
            // 'gender' => $data['gender'],
            // 'status' => $data['status'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => 1,
        ]);
    }
}

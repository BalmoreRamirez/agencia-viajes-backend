<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if($token = auth()->attempt($request->only('email', 'password')))
        {
            return response([
               'type' => 'Bearer',
               'access_token' => $token,
               'user' => auth()->user(),
            ], 200);
        }

        return response([
           'message' => 'credentials invalid',
           'status' => 409
        ],409);
    }

    /**
     *  Logout user
     */
    public function logout()
    {
        $user = auth()->user();

        auth()->logout();

        return $user;
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'password'=> 'required'

        ]);

        if (!$token = auth()->attempt($request-> only('email','password'))){

            return response('Not Authorized',401);
        }

        return response()->json(compact('token'));

    }
}
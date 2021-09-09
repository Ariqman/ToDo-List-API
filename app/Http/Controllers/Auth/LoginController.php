<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!$token = Auth::attempt($request->only('email','password'))){

            return response()
            ->json(['Status'=>'Error','Message'=>'Not Authorized'],401);
        }

        return response()
        ->json(['Status'=> 'Success','Message'=>'Login Berhasil !','Auth'=>compact('token'),'Data'=>$request->user()]);

    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        
        User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>bcrypt(request('password'))
            
        ]);

        return response()->json(['Status'=> 'Success','Message'=>'Terima Kasih Sudah Mendaftar!'],200);
    }
}

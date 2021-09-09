<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function home(Request $request)
    {
        return response()
        ->json(['Status'=> 'Success','Message'=>'Data User Didapatkan!','Data'=>$request->user()]);
    }
}

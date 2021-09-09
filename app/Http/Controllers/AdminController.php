<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function index()
        {
            $user = JWTAuth::parseToken()->authenticate();
            if($user->role=="admin" or $user->role=="superadmin")
            {
                $userr = User::all();
                return response()->json([
                "success" => "success",
                "data" => $userr,
                ]);
            }
            else
            {
                return response()->json(['error' => 'You are not admin'], 401);
            }
        }

        public function deleteUser($id)
        {
            $user = JWTAuth::parseToken()->authenticate();
            if($user->role=="admin" or $user->role=="superadmin")
            {
                $deleted = User::destroy($id);
                if($deleted)    {
                    return response()->json([
                        'message' => 'Successfully deleted the user'
                    ]);
                }
                else {
                    return response()->json([
                        'message' => 'Failed. User not found'
                    ]);
                }
            }
            else
            {
                return response()->json(['error' => 'You are not admin'], 401);
            }            

        }

        public function update(Request $request,$id)
        {
            $user = JWTAuth::parseToken()->authenticate();
            if($user->role=="admin" or $user->role=="superadmin")
            {
                    #getData and Auth
                    $userinput=User::find($id);
                    $input = $request->all();
                    #validator and update email
                    if(isset($input['email'])) {
                        $validator = Validator::make($input, [ 
                            'email' => 'unique:users', 
                            'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
                        ]);
                        if($validator->fails()) {
                            return response()->json([
                                "success" => "error",
                                "message" => "email already in use or invalid",
                                ]); }
                        $userinput->email = $input['email'];
                        }
                    #Update data name
                    if(isset($input['name'])) {
                        $userinput->name = $input['name']; }
                    #Update role ( only superadmin )
                    if($user->role == "superadmin")  {
                        if($input['role'] == "admin" or $input['role'] == "user") {
                            $userinput->role = $input['role'];
                        }
                        else {
                            return response()->json([
                                "success" => "error",
                                "message" => "Role not found",
                                ]);
                        }
                    }
                    $userinput->save();
                    return response()->json([
                    "success" => "success",
                    "message" => "User updated successfully.",
                    "data" => $userinput
                    ]);
                    }
                    else
                    {
                        return response()->json(['error' => 'You are not admin'], 401);
                    }    
        }

        public function adminLogin(Request $request)
        {
            $request->validate([
                'email'=> 'required',
                'password'=> 'required'
    
            ]);
    
            if (!$token = Auth::attempt($request-> only('email','password'))){
    
                return response()
                ->json(['Status'=>'Error','Message'=>'Not Authorized'],401);
            }
            
            if($request->user()->role == "admin" or $request->user()->role == "superadmin")
                {    
                    return response()
                    ->json(['Status'=> 'Success','Message'=>'Login Berhasil !','Auth'=>compact('token'),'Data'=>$request->user()]);
                }
            else {
                return response()->json(['error' => 'You are not admin'], 401);
            }
        }
    
        public function logout(Request $request)
        {
            Auth::logout();
            return response()->json(['Status'=> 'Success','Message'=>'Jangan Lupa Kembali !'],200);
        }
}

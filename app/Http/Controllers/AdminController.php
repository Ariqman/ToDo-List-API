<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class AdminController extends Controller
{
    public function index()
        {
            $userr = User::all();
            return response()->json([
            "success" => "success",
            "data" => $userr,
            ]);
        }

        public function deleteUser($id)
        {
            //
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

        public function update(Request $request,$id)
        {
            #getData and Auth
            $user = Auth::user();
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

        public function adminLogin(Request $request)
	    {
		    $request->validate([
                'email' => 'required|email',
    	    	'password' => 'required',
            ]);

            $credentials = $request->only(['email', 'password']);

		    if (Auth::attempt($credentials)) {
		    	$user = Auth::user();
                if($user->role == "admin") {
    		    	$success['token'] = $user->createToken('MyApp', ['admin'])->accessToken;
    		    	return response()->json(['success' => "200 OK", 'token' => $success['token'], 'data' => $user], 200);
                }
                else if($user->role == "superadmin") {
    		    	$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
    		    	return response()->json(['success' => "200 OK", 'token' => $success['token'], 'data' => $user], 200);
                }
                else {
                        return response()->json(['error' => 'You are not admin'], 401);
                }
        
		    }
		    else {
		    	return response()->json(['error' => 'You are not admin'], 401);
		    }
	    }
	
        public function logout(Request $request)
        {
            $logout = Auth::logout();
            if($logout){
                return response()->json([
                    'message' => 'Successfully logged out'
                ]);
            }
        }
}

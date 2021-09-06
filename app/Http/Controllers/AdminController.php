<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
        {
            $cok = auth();
            $userr = User::all();
            return response()->json([
            "success" => true,
            "message" => $cok,
            "data" => $userr
            ]);
        }

        public function updateUser(Request $request,$id)
        {
            //
            $user=User::find($id);
            $user->role = "user";
            $user->save();
            return $user;
    
        }

        public function updateAdmin(Request $request,$id)
        {
            //
            $user=User::find($id);
            $user->role = "admin";
            $user->save();
            return $user;
    
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
    		    	return response()->json(['success' => $success, 'data' => $user], 200);
                }
                else if($user->role == "superadmin") {
    		    	$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
    		    	return response()->json(['success' => $success, 'data' => $user], 200);
                }
                else {
                        return response()->json(['error' => 'You are not admin'], 401);
                }
        
		    }
		    else {
		    	return response()->json(['error' => 'You are not admin'], 401);
		    }
	    }
	

}

<?php

namespace App\Http\Controllers\toDoController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Lists;
use App\Rules\checkStatus;
use Tymon\JWTAuth\Facades\JWTAuth;

class toDoController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return lists::all();
    }

    public function userIndex($id)
    {
        return lists::where('user_id',$id)->get();
    }

    public function detail($id)
    {
        return lists::find($id);
    }

    public function create(request $request)
    {
        $list = new lists();

        $img = $request->file('image');
        $imgName = time() . "_" . $img->getClientOriginalName();
        $destination = 'upload/';
        $path = $destination . $imgName;
        $img->move($destination, $imgName);

        $list->user_id = $request->user_id;
        $list->title = $request->title;
        $list->status = $request->status;
        $list->image = $path;
        $list->description = $request->description;
        $list->save();

        return response()->json(['status' => 'success', 'message' => 'List telah dibuat', 'data' => $list], 200);
    }

    public function update(request $request, $id)
    {
        $list = lists::find($id);

        if ($img = $request->file('image')) {
            if ($list->image != ''  && $list->image != null) {
                File::delete(public_path($list->image));
            }

            $imgName = time() . "_" . $img->getClientOriginalName();
            $destination = 'upload/';
            $path = $destination . $imgName;
            $img->move($destination, $imgName);
            $list->image = $path;
        }

        $list->title = $request->title;
        $list->description = $request->description;
        $list->save();

        return response()->json(['status' => 'success', 'message' => 'List telah diperbarui', 'data' => $list], 200);
    }

    public function updateStatus(request $request, $id)
    {
        $validator = Validator::make($request->all(),
            ['status' => new checkStatus()]
        );
        
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first() ], 400);
        }

        else{
            $list = lists::find($id);
            $list->status = strtolower($request->status);
            $list->save();
            return response()->json(['status' => 'success', 'message' => 'status telah diperbarui', 'data' => $list], 200);
        }
        
    }

    public function delete($id)
    {
        if ($list = lists::find($id)) {
            File::delete(public_path($list->image));
            $list->delete();
            return response()->json(['status' => 'success', 'message' => 'List telah berhasil dihapus', 'data' => $list], 200);
        };
    }
}

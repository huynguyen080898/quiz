<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getUser(){
        $user = User::find(Auth::user()->id);
        $total_result = Result::where([['user_id', Auth::user()->id],['status','close']])->count();
        return view('home.user-profile', compact(['user','total_result']));
    }

    public function getUsers(){
        $users = User::all();
        return view('admin.user.index',compact('users')); 
    }

    public function putUser(Request $request)
    {        
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'mimes:png,jpg,jpeg'
            ],[
                'avatar.mimes' => 'Ảnh không đúng định dạng '
            ]);
            $avatar = Storage::disk('s3')->put('user-images', $request->avatar, 'r');

            $avatar_url = Storage::disk('s3')->url($avatar);

            $request->merge(['avatar_url' => $avatar_url]);
        }

        $data = User::find(Auth::user()->id);

        $data->fill($request->all());
        $data->save();
        return redirect()->back()->with('messages', 'Lưu thành công');
    }
}

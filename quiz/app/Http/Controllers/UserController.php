<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUser($user_id){
        $user = User::find($user_id);
        return $user;
    }

    public function getUsers(){
        $users = User::all();
        return view('admin.user.index',compact('users')); 
    }
}

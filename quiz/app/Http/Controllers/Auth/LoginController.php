<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        session(['link' => url()->previous()]);
        
        if(Auth::check()){
            return redirect(session('link'));
        }
        
        return view('home.auth.login');
    }
    
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(session('link') == route('register.get')){
                return redirect()->route('home.index');
            }
            return redirect(session('link'));
        } 
            
        return redirect()->back()->with('messages', 'Tài khoản hoặc mật khẩu không chính xác');
    }
}

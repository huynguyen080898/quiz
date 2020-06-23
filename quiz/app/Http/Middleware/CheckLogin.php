<?php

namespace App\Http\Middleware;

class CheckLogin{

    public function handle($request)
    {
        if ($request->user()->role == 'admin'){
            return $next($request);
        }
        return redirect()->route('home.index');
    }
}
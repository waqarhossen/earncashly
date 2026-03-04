<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class verification_page
{

    public function handle(Request $request, Closure $next)
    {
        
        if(!empty(Auth::user())){
        if(Auth::user()->is_verified!=NULL){
        return redirect()->to('/');
        }
        }
        
        return $next($request);
    }
}

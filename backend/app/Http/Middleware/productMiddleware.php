<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class productMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){

        if(auth()->user()->email==="luedco2009@gmail.com"){
            return $next($request);
        }else{
            return response()->json('access denied');
        }
    }else{return response()->json('token not found');
    }
       
    }
}

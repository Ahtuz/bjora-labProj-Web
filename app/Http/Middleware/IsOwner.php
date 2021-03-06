<?php

namespace Bjora\Http\Middleware;

use Closure;
use Bjora\User;
use Illuminate\Support\Facades\Auth;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::id() == $request->id){
                return $next($request);
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
}

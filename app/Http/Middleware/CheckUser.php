<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (\Auth::user() &&  \Auth::user()->role != 1) {
            return $next($request);
        }
        
        if(\Auth::user()->role && $check_user==1){
            return redirect('/home');
        }
        return redirect('/');
    }
}

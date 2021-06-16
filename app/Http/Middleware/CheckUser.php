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
        if (\Auth::user() &&  \Auth::user()->role == 2) {
            return $next($request);
        }
        
        if(\Auth::user()->role && \Auth::user()->role==1){
            return redirect('/home');
        }
        if(\Auth::user()->role && \Auth::user()->role==3){
            return redirect('salesperson/home');
        }
        return redirect('/');
    }
}

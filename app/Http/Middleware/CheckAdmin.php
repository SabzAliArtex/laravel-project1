<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if (\Auth::user() &&  \Auth::user()->role == 1) {
                return $next($request);
         }

        if(\Auth::user() && \Auth::user()->role ==2){
            $user_role = 'user';
            return redirect($user_role.'/home');
        }
        
        return redirect('/');
    }
}

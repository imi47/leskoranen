<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(\Auth::check() AND \Auth::user()->is_admin){
            if(\Auth::user()->status == 0 OR \Auth::user()->is_blocked == 1)
            {
                if(request('json' , 'not') == 'not')
                {
                    \Auth::logout();
                    return redirect(admin());
                }
            }
            return $next($request);
        }else{
            return redirect(admin());
        }
    }
}

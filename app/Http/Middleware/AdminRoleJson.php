<?php

namespace App\Http\Middleware;

use Closure;

class AdminRoleJson
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
        if(\Auth::check() AND \Auth::user()->is_admin AND \Auth::user()->role == 3){
            if(\Auth::user()->status == 0 OR \Auth::user()->is_blocked == 1)
            {
                \Auth::logout();
                $data['feedback'] = 'login_issue';
                echo json_encode($data);
                exit;
            }
            return $next($request);
        }else{
            $data['error_msg'] = 'You are not Allowed to access this thing';
            $data['feedback'] = 'role_issue';
            echo json_encode($data);
            exit;
        }
    }
}

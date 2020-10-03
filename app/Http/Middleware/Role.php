<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role='administrador')
    {
        if(!auth()->check()){
            abort(403);
        }
        $roles = explode('-', $role);

        if($request->user()->has_any_role($roles)){
            return $next($request);
        }else{
            abort(403);
        }
 
    }
}

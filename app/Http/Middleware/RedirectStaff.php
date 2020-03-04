<?php

namespace App\Http\Middleware;

use Closure;

class RedirectStaff
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
        if(auth()->check() && auth()->user()->role == '2')
        {
           alert()->success('Welcome Back ','Success');
            return redirect()->action('StaffController@staffIndex');
        }
        return $next($request);
    }
}

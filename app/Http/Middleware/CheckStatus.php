<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$statuss)
    {
        if(in_array($request->user()->status,$statuss)){
            return $next($request);
        }
        return redirect('/');
    }
}

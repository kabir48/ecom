<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip=\Request::ip();
        if(geoip()->getLocation($ip=Null)->country =='Bangladesh'){
            $next;
        }else{
             abort(403, "You are restricted to access the site.");
        }
        
        return $next($request);
        
    }
}

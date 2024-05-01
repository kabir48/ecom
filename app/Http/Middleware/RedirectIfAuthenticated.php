<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
        // Customize the redirection if the user is already authenticated
        if (Auth::user()->isCustomer()) {
            return redirect('/customer/dashboard');
        }

        // Redirect to the intended URL or a default page
        return redirect()->intended('/');
    }

    return $next($request);
    }
}

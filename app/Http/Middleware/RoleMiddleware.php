<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::user()) {
            return redirect()->route('login'); // Redirect to the login page
        }

        Debugbar::info($roles);

        foreach ($roles as $role) {
            if (Auth::user()->role === $role) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized');
    }
}

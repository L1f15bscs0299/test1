<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        session_start();
        if (isset($_SESSION['logged_in_user'])) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}

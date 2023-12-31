<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && $request->path() !== 'login') {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        return $next($request);
    }
}

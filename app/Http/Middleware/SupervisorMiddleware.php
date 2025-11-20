<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupervisorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'supervisor') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Unauthorized access.');
    }
}
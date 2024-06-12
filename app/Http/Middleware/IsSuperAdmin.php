<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role == 1) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is admin by email
        if ($request->user()->email !== 'admin@gmail.com') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403);
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return $next($request);
    }
}

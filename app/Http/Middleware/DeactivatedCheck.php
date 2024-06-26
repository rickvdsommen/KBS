<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeactivatedCheck
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->deactivated) {
            auth()->logout(); // Logout the user
            return redirect()->route('login')->with('error', 'Dit account is gedeactiveerd.');
        }

        return $next($request);
    }
}

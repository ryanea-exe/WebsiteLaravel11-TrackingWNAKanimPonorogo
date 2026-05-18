<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role != $role) {

            // arahkan sesuai role user, BUKAN ke dashboard umum
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if (auth()->user()->role == 'staff') {
                return redirect()->route('user.dashboard');
            }

            abort(403);
        }

        return $next($request);
    }
}
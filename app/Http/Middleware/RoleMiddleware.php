<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (! $user) {
            return response()->view('errors.access-denied', status: 403);
        }

        if (is_numeric($role)) {
            if ($user->role_id != (int) $role) {
                return response()->view('errors.access-denied', status: 403);
            }
        } elseif ($user->role?->name !== $role) {
            return response()->view('errors.access-denied', status: 403);
        }

        return $next($request);
    }
}

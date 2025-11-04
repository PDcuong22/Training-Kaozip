<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (! $user) {
            // chưa đăng nhập -> chuyển đến login hoặc abort
            return redirect()->route('login');
        }

        // nếu relation đã load thì kiểm tra collection, ngược lại query DB
        if ($user->relationLoaded('roles')) {
            if ($user->roles->contains('name', $role)) {
                return $next($request);
            }
        } else {
            if ($user->roles()->where('name', $role)->exists()) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized');
    }
}

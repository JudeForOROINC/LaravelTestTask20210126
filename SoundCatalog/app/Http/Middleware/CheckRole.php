<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param string $role
     * @param string|null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role, string $permission = null)
    {
        $user = auth()->user();

        if (!$user) {
            $this->exitFromMiddleware();
        }

        if (!$user->hasRole($role)) {
            $this->exitFromMiddleware();
        }

        if ($permission && !$user->hasPermission($permission)) {
            $this->exitFromMiddleware();
        }


        return $next($request);
    }

    private function exitFromMiddleware() {
        abort(403);
    }
}

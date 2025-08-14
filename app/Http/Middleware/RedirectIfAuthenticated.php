<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$guards,
    ): Response {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($$guard)->check()) {
                return redirect($this->redirectTo($request, $guard));
            }
        }
        return $next($request);
    }

    protected function redirectTo(
        Request $request,
        ?string $guard = "web",
    ): ?string {
        return static::$redirectToCallback
            ? call_user_func(static::$redirectToCallback, $request)
            : $this->defaultRedirectUri($guard);
    }

    protected function defaultRedirectUri($guard): string
    {
        if ($guard === "admin") {
            return Route::has("admin.dashboard")
                ? route("admin.dashboard")
                : "/admin/dashboard";
        }

        if ($guard === "web") {
            return Route::has("dashboard") ? route("dashboard") : "/dashboard";
        }

        return "/";
    }

    public static function redirectUsing(callable $redirectToCallback)
    {
        static::$redirectToCallback = $redirectToCallback;
    }
}

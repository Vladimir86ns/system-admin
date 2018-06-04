<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class RedirectIfAuthenticatedInvestments
{
    const ROUTE = 'investments-admin';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Sentinel::getUser()) {
            return redirect(self::ROUTE . '/login');
        }

        $permissions = Sentinel::getUser()->permissions;

        if ($permissions['investor'] == 1) {
            return $next($request);
        }
        
        return redirect(self::ROUTE . '/login');
    }
}

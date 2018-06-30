<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class CheckOwner
{
    const ROUTE = 'chose-status';

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
            return redirect(self::ROUTE);
        }

        $permissions = Sentinel::getUser()->permissions;

        if (empty($permissions['owner'])) {
            return redirect(self::ROUTE);
        }

        if ($permissions['owner'] == 1) {
            return $next($request);
        }

        return redirect(self::ROUTE);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request):Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((bool) Setting::getValueByKey('maintenance_mode')) {
            if (! Auth::check()) {
                abort(503, 'The site is under maintenance. Please check back later.');
            }
        }

        return $next($request);
    }
}

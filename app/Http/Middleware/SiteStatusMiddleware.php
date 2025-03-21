<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = Setting::getValueByKey('site_status');

        if (! $status) {
            if (! auth()->check()) {
                return abort(503);
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request):Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        $urlMaps = Cache::rememberForever('redirections', function () {
            return collect(Setting::getValueByKey('redirections'));
        });

        $uri = urldecode($request->getUri());
        $requestUri = urldecode($request->getRequestUri());

        $uri = Str::ascii($uri);
        $requestUri = Str::ascii($requestUri);

        $uriWithoutProtocol = Str::after($uri, '://');

        $current = [
            'full' => $uri,
            'fullNoQuery' => Str::beforeLast($uri, '?'),
            'fullWithTrailingSlash' => Str::finish($uri, '/'),
            'fullWithoutTrailingSlash' => Str::replaceEnd('/', '', $uri),
            'fullWithoutProtocol' => $uriWithoutProtocol,
            'fullWithoutProtocolNoQuery' => Str::beforeLast($uriWithoutProtocol, '?'),
            'path' => $requestUri,
            'pathNoQuery' => Str::beforeLast($requestUri, '?'),
            'pathWithTrailingSlash' => Str::finish($requestUri, '/'),
            'pathWithoutTrailingSlash' => Str::replaceEnd('/', '', $requestUri),
            'exceptLastEqual' => Str::beforeLast($uri, '='),
        ];

        $matchingUrlMap = $urlMaps->first(function ($urlMap) use ($current) {
            $from = $urlMap['old_url'];
            $fromWithoutProtocol = preg_replace('~^https?://~', '', $from);
            $hasWildcard = Str::contains($from, '*');

            return
                ($hasWildcard && Str::is($from, $current['path'])) ||
                ($hasWildcard && Str::is($from, $current['full'])) ||
                ($hasWildcard && Str::is($fromWithoutProtocol, $current['fullWithoutProtocol'])) ||
                in_array($from, $current) ||
                ($fromWithoutProtocol === $current['fullWithoutProtocol']) ||
                ($fromWithoutProtocol === $current['fullWithoutProtocolNoQuery']);
        });

        if ($matchingUrlMap) {
            $to = $matchingUrlMap['new_url'];
            $statusCode = $matchingUrlMap['status_code'] ?? 301;

            $queryString = $request->getQueryString();
            if ($queryString) {
                parse_str($queryString, $queryParams);
                $queryParams = array_filter($queryParams, function ($value) {
                    return $value !== '';
                });

                $queryString = http_build_query($queryParams);
                $to .= '?'.$queryString;
            }

            return redirect()->to($to, $statusCode);
        }

        return $next($request);
    }
}

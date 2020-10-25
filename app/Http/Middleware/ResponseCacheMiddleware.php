<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class ResponseCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = '|request|'.$request->url().'|'. 'activity-' . $request->input('activity') . '|activityType-' . $request->input('activityType') . '|country-' . $request->input('country') . '|fuelType-' . $request->input('fuelType') . '|mode-' . $request->input('mode') ;
        return Cache::store('database')->remember($key, 24 * 60 * 60 , function () use($request, $next) {
            return $next($request);
        });
    }
}

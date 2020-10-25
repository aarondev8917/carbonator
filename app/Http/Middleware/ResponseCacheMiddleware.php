<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Illuminate\Support\Facades\Validator;
use App\Rules\Lowercase;
use App\Rules\Supportedcountries;

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

        $validator = Validator::make($request->all(), [
            'activity' => 'required|integer|gt:0',
            'activityType' => 'required|string',
            'country' => ['required', 'string', new Lowercase, new Supportedcountries]
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                return response()->json([
                    'error' => true,
                    'message' => $message
                 ],200); 
            }
        }

        $key = '|request|'.$request->url().'|'. 'activity-' . $request->input('activity') . '|activityType-' . $request->input('activityType') . '|country-' . $request->input('country') . '|fuelType-' . $request->input('fuelType') . '|mode-' . $request->input('mode') ;
        return Cache::store('database')->remember($key, 24 * 60 * 60 , function () use($request, $next) {
            return $next($request);
        });
    }
}

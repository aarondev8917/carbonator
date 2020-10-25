<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $validatorArray = [
            'activity' => 'required|integer|gt:0',
            'activityType' => 'required|string',
            'country' => ['required', 'string', new Lowercase, new Supportedcountries],
            'activityType' => [Rule::in(['miles', 'fuel'])]
        ];

        if($request->has('fuelType') && $request->filled('fuelType')){
            $fuelTypeInput = $request->input('fuelType');
            $validatorArray['fuelType'] = ['required',
                Rule::exists('fuelType', 'name')->where(function ($query) use($fuelTypeInput ) {
                    return $query->where('name', $fuelTypeInput);
                })
            ];
        }

        if($request->has('mode')  && $request->filled('mode')){
            $modeInput = $request->input('mode');
            $validatorArray['mode'] = ['required',
                Rule::exists('modes', 'name')->where(function ($query) use($modeInput) {
                    return $query->where('name', $modeInput);
                })
            ];
        }
        
        
        $validator = Validator::make($request->all(), $validatorArray);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                return response()->json([
                    'error' => true,
                    'message' => $message
                 ],400); 
            }
        }

        $key = '|request|'.$request->url().'|'. 'activity-' . $request->input('activity') . '|activityType-' . $request->input('activityType') . '|country-' . $request->input('country') . '|fuelType-' . $request->input('fuelType') . '|mode-' . $request->input('mode') ;
        return Cache::store('database')->remember($key, 24 * 60 * 60 , function () use($request, $next) {
            return $next($request);
        });
    }
}

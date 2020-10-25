<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\FootprintRepository;
use Illuminate\Http\Request;

use App\Http\Middleware\Middleware;
use DB;

class FootprintController extends Controller
{

    public function __construct(FootprintRepository $footprintRepository )
    {
        $this->footprintRepository = $footprintRepository;
        $this->middleware('cache.response', ['except' => ['index','show']]);
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $footprintParams = [
            'activity' => $request->input('activity'),
            'activityType' => $request->input('activityType'),
            'country' =>  $request->input('country')
        ];

        $insertParams = [
            'activity' => $request->input('activity'),
            'activity_type' => $request->input('activityType'),
            'country' =>  $request->input('country')
        ];

        if(!empty($request->input('fuelType'))){
            $footprintParams['fuelType'] = $request->input('fuelType');
            $insertParams['fuel_type_id'] = DB::table('fuelType')->where('name',  $request->input('fuelType'))->first();
        }

        if(!empty($request->input('mode'))){
            $footprintParams['mode'] = $request->input('mode');
            $insertParams['mode_id'] = DB::table('modes')->where('name',  $request->input('mode'))->first();
        }

        $response =  $this->footprintRepository->getFootprint($footprintParams);
        // $insertParams['response'] = $response->getData();
        // DB::table('footprints')->insert([$insertParams]);
        return $response;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

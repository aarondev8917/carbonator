<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\FootprintRepository;
use Illuminate\Http\Request;

use App\Http\Middleware\Middleware;

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
        //
        //echo "hi";
        $footprintParams = [
            'activity' => $request->input('activity'),
            'activityType' => $request->input('activityType'),
            'country' =>  $request->input('country')
        ];

        if(!empty($request->input('fuelType'))){
            $footprintParams['fuelType'] = $request->input('fuelType');
        }

        if(!empty($request->input('mode'))){
            $footprintParams['mode'] = $request->input('mode');
        }

        return $this->footprintRepository->getFootprint($footprintParams);


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

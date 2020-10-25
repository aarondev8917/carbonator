<?php

namespace App\Repositories;

use App\Http\Resources\Footprint;
/**
 * FootprintRepository for handling the controller logic for API
 */
class FootprintRepository {

    protected $url = "https://api.triptocarbon.xyz/v1/footprint?";

    public function getFootprint($params)
    {
        $fullUrl = $this->url . http_build_query($params);
        $response = file_get_contents($fullUrl, false);
        // return as array
        $data = json_decode($response, true);
        return Footprint::make($data)->resolve();
    }

}
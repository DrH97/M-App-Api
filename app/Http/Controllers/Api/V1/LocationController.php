<?php

namespace App\Http\Controllers\Api\V1;

use App\Location;
use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::all();

        $locations = $locations ? $locations : [];

        $response = [
            'status' => 'success',
            'total_results' => count($locations),
            'results' => $locations,
        ];
       
        return response() ->json($response);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($location)
    {
        //

        $location = Location::find($location);

        $location = $location ? array($location) : [];

        $response = [
            'status' => 'success',
            'total_results' => count($location),
            'results' => $location,
        ];
       
        return response() ->json($response);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Location  $location
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Location $location)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Location  $location
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Location $location)
    // {
    //     //
    // }

    /**
     * Display a listing of places of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLocationPlaces($id)
    {
        //
        $location = Location::find($id);

        $location = $location ? $location->places : [];

        $response = [
            'status' => 'success',
            'total_results' => count($location),
            'results' => $location,
        ];
       
        return response() ->json($response);
    }

    /**
     * Display the specified place of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLocationPlace($location_id, $id)
    {
        //
        // $place = Place::where('location_id', $location_id)->get();
        // $place = $place->find($id);

        $place = Location::find($location_id)->places->where('id', $id);

        $response = [
            'status' => 'success',
            'total_results' => count($place),
            'results' => $place,
        ];
       
        return response() ->json($response);
    }

}

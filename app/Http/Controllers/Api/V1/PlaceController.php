<?php

namespace App\Http\Controllers\Api\V1;

use App\Place;
use App\PlaceActivity;
use App\Activity;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $places = Place::all();

        $places = $places ? $places : [];

        foreach ($places as $place) {
            $place['location'] = Location::find($place->location_id)->area;
        }

        $response = [
            'status' => 'success',
            'total_results' => count($places),
            'results' => $places,
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
    public function show($place)
    {
        //
        $place = Place::find($place);

        $place = $place == null ? [] : array($place);

        foreach ($place as $p) {
            $p['location'] = Location::find($p->location_id)->area;
        }

        $response = [
            'status' => 'success',
            'total_results' => count($place),
            'results' => $place,
        ];
       
        return response() ->json($response);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Place  $place
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Place $place)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Place  $place
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Place $place)
    // {
    //     //
    // }

    /**
     * Display a listing of activities of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPlaceActivities($id)
    {
        //
        $place = Place::find($id);

        $placeactivities = $place == null ? [] : $place->placeActivities;

        foreach ($placeactivities as $pA) {
            $pA['activity_name'] = $pA->activity->name;
            $pA['activity_description'] = $pA->activity->description;
            $pA['latitude'] = Location::find($pA->location_id)->latitude;
            $pA['longitude'] = Location::find($pA->location_id)->longitude;
            unset($pA['activity']);
        }

        $response = [
            'status' => 'success',
            'total_results' => count($placeactivities),
            'results' => $placeactivities,
        ];

        return response()->json($response);
    }

    /**
     * Display the specified activity of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlaceActivity($place_id, $id)
    {
 
        $place = Place::find($place_id);

        $activity = $place == null ? [] : $place->placeActivities->where('activity_id', $id);

        foreach ($activity as $act) {
            $act['activity'] = $act->activity->name;
        }

        $response = [
            'status' => 'success',
            'total_results' => count($activity),
            'results' => $activity,
        ];

        return response()->json($response);
    }

    public function findLocationArea($place) {
        // $place = Place::find($place);

        $response = [
            'status' => 'success',
            'total_results' => count(array($place)),
            'results' => Location::find($place->location_id)->area,
        ];

        return response()->json($response);
    }
}

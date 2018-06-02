<?php

namespace App\Http\Controllers\Api\V1;

use App\Place;
use App\PlaceActivity;
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
        return Place::all();
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

        return $place == null ? [] : $place;
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

        return $place->placeActivities;
    }

    /**
     * Display the specified activity of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlaceActivity($place_id, $id)
    {
        //
        // $activity = PlaceActivity::where('place_id', $place_id)->get();
        // $activity = $activity->find($id);

        $activity = Place::find($place_id)->placeActivities->where('activity_id', $id);

        return $activity == null ? [] : $activity;
    }

}

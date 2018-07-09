<?php

namespace App\Http\Controllers\Api\V1;

use App\Activity;
use App\PlaceActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $activities = Activity::all();

        $response = [
            'status' => 'success',
            'total_results' => count($activities),
            'results' => $activities,
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
    public function show($activity)
    {
        //
        $activity = Activity::find($activity);

        $activity = $activity == null ? [] : array($activity);

        foreach ($activity as $p) {
            $p->parentActivities->name;
        }

        $response = [
            'status' => 'success',
            'total_results' => count($activity),
            'results' => $activity,
        ];
       
        return response() ->json($response);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Activity  $activity
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Activity $activity)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Activity  $activity
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Activity $activity)
    // {
    //     //
    // }

    /**
     * Display a listing of places of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActivityPlaces($id)
    {
        //
        $activity = Activity::find($id);
        
        $activity = $activity == null ? [] : $activity->placeActivities;

        $response = [
            'status' => 'success',
            'total_results' => count($activity),
            'results' => $activity,
        ];
       
        return response() ->json($response);
    }

    /**
     * Display the specified place of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showActivityPlace($activity_id, $id)
    {

        $activity = Activity::find($activity_id)->placeActivities->where('place_id', $id);

        $activity = $activity == null ? [] : $activity;

        $response = [
            'status' => 'success',
            'total_results' => count($activity),
            'results' => $activity,
        ];
       
        return response() ->json($response);
    }

}

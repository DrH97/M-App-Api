<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    //
    use SoftDeletes;

    public function placeActivities() {
        return $this->hasMany('App\PlaceActivity');
    }

    public function parentActivities() {
        return $this->belongsTo('App\Activity', 'parent_id');
    }
}

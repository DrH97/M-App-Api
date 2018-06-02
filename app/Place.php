<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    //
    use SoftDeletes;

    public function location() {
        return $this->hasOne('App\Location');
    }

    public function placeActivities() {
        return $this->hasMany('App\PlaceActivity');
    }
}

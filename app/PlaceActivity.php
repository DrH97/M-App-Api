<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceActivity extends Model
{
    //
    use SoftDeletes;

    public function place() {
        return $this->belongsTo('App\Place');
    }

    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}

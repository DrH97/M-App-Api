<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    use SoftDeletes;

    public function places() {
        return $this->hasMany('App\Place');
    }
}

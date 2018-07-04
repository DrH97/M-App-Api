<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'description', 'location_id'
    ];

    public function location() {
        return $this->hasOne('App\Location', "id");
    }

    public function placeActivities() {
        return $this->hasMany('App\PlaceActivity');
    }
}

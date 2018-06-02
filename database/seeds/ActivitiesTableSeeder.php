<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Activity::class, 5)->create()
            ->each(function ($a) {
                $a->placeActivities()->save(factory(App\PlaceActivity::class)->make());
        });  
    }
}

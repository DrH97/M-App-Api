<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Location::class, 5)->create()
            ->each(function ($l) {
                $l->places()->save(factory(App\Place::class)->make());
        });            
    }
}

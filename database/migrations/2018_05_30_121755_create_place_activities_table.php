<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->float('price');
            $table->float('offer')->nullable();
            $table->string('type')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_activities');
    }
}

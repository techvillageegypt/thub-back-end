<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('housing_type')->nullable()->comment(' 1 => House, 2 => Apartment');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('house_number')->nullable();
            $table->string('building_number')->nullable();

            $table->string('apartment_number')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });

        Schema::create('driver_weight', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('driver_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->unsignedInteger('weight')->nullable();

            // $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_weight');
        Schema::drop('drivers');
    }
}

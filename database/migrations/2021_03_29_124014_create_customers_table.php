<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('housing_type')->nullable()->comment(' 1 => House, 2 => Apartment');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('house_number')->nullable();
            $table->string('building_number')->nullable();

            $table->string('apartment_number')->nullable();

            // $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });

        Schema::create('customer_donations', function (Blueprint $table) {
            $table->increments('id')->from(10000);
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->dateTime('pickup_date')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->unsignedTinyInteger('housing_type')->nullable()->comment(' 1 => House, 2 => Apartment');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('house_number')->nullable();
            $table->string('building_number')->nullable();

            $table->string('apartment_number')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('0 => New, 1 => Picked up, 2 => Delivered, 3 => Not Picked up, 4 => Reschedule, 5 => InProgress');
            $table->text('driver_notes')->nullable();
            $table->text('customer_notes')->nullable();

            $table->unsignedInteger('bags')->nullable();
            $table->unsignedInteger('plastic_bags')->nullable();
            $table->unsignedInteger('cartons')->nullable();
            $table->unsignedInteger('cars')->nullable();

            $table->unsignedTinyInteger('feedback')->nullable();
            $table->text('feedback_notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_donations');
        Schema::drop('customers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon');
            $table->string('web_icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('donation_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('donation_type_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('name');

            $table->unique(['donation_type_id', 'locale']);

            $table->foreign('donation_type_id')->references('id')->on('donation_types')->onDelete('cascade');
        });



        Schema::create('donation_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donation_id')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('donation_id')->references('id')->on('customer_donations')->onDelete('cascade');
        });

        Schema::create('type_of_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donation_id')->nullable();
            $table->unsignedInteger('donation_type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('donation_id')->references('id')->on('customer_donations')->onDelete('cascade');
            $table->foreign('donation_type_id')->references('id')->on('donation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('type_of_donations');
        Schema::drop('donation_photos');
        Schema::drop('donation_type_translations');
        Schema::drop('donation_types');
    }
}

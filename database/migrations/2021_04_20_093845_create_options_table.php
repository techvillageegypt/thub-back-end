<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->default('logo.png');
            $table->string('fav_icon')->default('fav_icon.png');
            $table->string('welcome_photo')->default('welcome.jpg');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('option_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('welcome_message')->default('Welcome to Thub');

            $table->unique(['option_id', 'locale']);

            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('option_translations');
        Schema::drop('options');
    }
}

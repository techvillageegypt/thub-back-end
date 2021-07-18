<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedTinyInteger('status')->default(1)->comment('0 => Inactive, 1 => Active');
            $table->unsignedInteger('parent_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('category_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('locale', 2)->index();

            $table->string('name');
            $table->string('brief')->nullable();

            $table->unique(['category_id', 'locale']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->from(10000);
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('driver_id')->nullable();
            $table->text('driver_notes')->nullable();
            $table->string('state')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('housing_type')->nullable()->comment(' 1 => House, 2 => Apartment');
            $table->string('house_number')->nullable();
            $table->string('building_number')->nullable();

            $table->string('apartment_number')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->integer('payment_method')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('order_id');
            $table->string('title');
            $table->string('color');
            $table->string('size');
            $table->decimal('price');
            $table->integer('quantity');

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('product_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_items');
        Schema::drop('orders');
    }
}

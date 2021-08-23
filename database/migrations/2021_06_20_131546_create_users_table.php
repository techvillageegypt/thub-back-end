<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('userable');
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->string('verify_code')->nullable();
            $table->string('device_id')->nullable();
            $table->string('balance')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment('0 => Inactive, 1 => Active');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

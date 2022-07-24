<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_location_id')->references('id')->on('parking_locations');
            $table->string('code');
            $table->string('vehicle');
            $table->bigInteger('amount');
            $table->string('check_in');
            $table->string('check_out');
            $table->string('payment_status');
            $table->string('payment_type');
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
        Schema::dropIfExists('parking_histories');
    }
};

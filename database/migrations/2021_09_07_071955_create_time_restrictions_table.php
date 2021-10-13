<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_restrictions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('booking_restriction_id');
            $table->foreignId('restriction_description_id')->nullable();
            $table->string('time_interval_type');
            $table->unsignedInteger('min_time');
            $table->unsignedInteger('max_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_restrictions');
    }
}

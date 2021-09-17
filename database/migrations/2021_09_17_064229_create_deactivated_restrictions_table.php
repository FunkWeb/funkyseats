<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeactivatedRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deactivated_restrictions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('from');
            $table->dateTime('to');
            $table->foreignId('booking_restriction_id');
            $table->foreignId('restriction_description_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deactivated_restrictions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_restrictions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('restriction_description_id')->nullable();
            $table->boolean('is_bookable');
            $table->boolean(('needs_approval'));
            //TODO: Add role restrictions if user roles become a thing 
            // $table->foreignId('role_restrictions_id')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_restrictions');
    }
}

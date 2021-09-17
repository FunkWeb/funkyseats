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
            $table->boolean(('needs_approval'));
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

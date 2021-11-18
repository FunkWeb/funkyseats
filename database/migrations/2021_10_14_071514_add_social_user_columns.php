<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->string('user_thumbnail')->nullable();
            $table->string('given_name')->nullable();
            $table->string('family_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('social_id');
            $table->dropColumn('social_type');
            $table->dropColumn('user_thumbnail');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDobPhoneAddresProfilePictureFieldsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('dob', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dob');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
            $table->dropColumn('profile_picture');
        });
    }
}

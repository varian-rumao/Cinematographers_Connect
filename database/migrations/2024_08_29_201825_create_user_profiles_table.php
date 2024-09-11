<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    public function up()
{
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('business_email')->default(''); // Allows default empty value
        $table->string('mobile_number')->nullable();   // Allows null values
        $table->string('location')->nullable();        // Allows null values
        $table->text('other_details')->nullable();     // Allows null values
        $table->string('profile_picture')->nullable(); // Allows null values
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('works', function (Blueprint $table) {
        $table->string('image_url')->nullable()->change(); // Allow image_url to be nullable
        $table->string('video_url')->nullable()->change(); // Allow video_url to be nullable
    });
}

public function down()
{
    Schema::table('works', function (Blueprint $table) {
        $table->string('image_url')->nullable(false)->change(); // Revert changes
        $table->string('video_url')->nullable(false)->change();
    });
}
};
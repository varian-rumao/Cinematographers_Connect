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
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('is_admin')->default(0); // Adds an is_admin column with a default value of 0
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('is_admin');
    });
}
};

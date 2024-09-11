<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWorksTableWithProfileImages extends Migration
{
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            // Check if the columns exist before adding
            if (!Schema::hasColumn('works', 'user_id')) {
                $table->unsignedBigInteger('user_id')->index()->after('id'); // Foreign key to users table
            }
            if (!Schema::hasColumn('works', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('works', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('works', 'work_image')) {
                $table->string('work_image')->nullable(); // To store the path of work images
            }
        });
    }

    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            // Drop the columns if they exist
            if (Schema::hasColumn('works', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('works', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('works', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('works', 'work_image')) {
                $table->dropColumn('work_image');
            }
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloudThresholdToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            // Add the cloud_threshold column
            $table->integer('cloud_threshold')->default(15); // Default to 15% cloud coverage
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            // Drop the cloud_threshold column if we need to rollback
            $table->dropColumn('cloud_threshold');
        });
    }
}

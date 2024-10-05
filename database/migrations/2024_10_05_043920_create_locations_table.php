<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to user
            $table->string('place_name')->nullable();  // Name of the location (optional)
            $table->decimal('latitude', 10, 8);        // Latitude, precision up to 8 decimal places
            $table->decimal('longitude', 11, 8);       // Longitude, precision up to 8 decimal places
            $table->integer('lead_time')->default(30); // Lead time in minutes before overpass (default 30 minutes)
            $table->enum('notification_method', ['email', 'sms', 'both'])->default('email'); // Notification method
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

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
      Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('device_identifier')->unique(); // Unique identifier for each device (e.g., IMEI, serial number, or a custom ID)
        $table->string('department')->nullable();
        $table->string('service')->nullable();
        // Add other relevant device fields (e.g., model, operating system) as needed
        $table->timestamps();

        $table->index('device_identifier');

      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};

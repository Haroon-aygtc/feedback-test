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
        Schema::create('option_translations', function (Blueprint $table) {
          $table->id();
          $table->foreignId('option_id')->constrained()->onDelete('cascade');
          $table->string('locale');
          $table->string('option_text');
          $table->string('image_path')->nullable(); // Consistent naming
          $table->timestamps();

          $table->unique(['option_id', 'locale']);

          $table->index('option_id');
          $table->index('locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_translations');
    }
};
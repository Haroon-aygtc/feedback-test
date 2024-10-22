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
        Schema::create('question_translations', function (Blueprint $table) {
          $table->id(); // Primary key
          $table->foreignId('question_id')->constrained()->onDelete('cascade');
          $table->string('locale'); // e.g., 'en', 'ar'
          $table->string('title');
          $table->text('description');
          $table->string('question_text');
          $table->timestamps();

          $table->unique(['question_id', 'locale']);

          $table->index('question_id');
          $table->index('locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_translations');
    }
};

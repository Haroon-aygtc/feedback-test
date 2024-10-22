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
      Schema::create('answers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->string('survey_id', 36)->index();
        $table->foreignId('device_id')->nullable()->constrained()->onDelete('cascade');
        $table->json('answer_data');
        $table->string('locale');
        $table->timestamps();

        // Add indexes:
        $table->index('question_id');
        $table->index('device_id');
        $table->index('locale');

        // Add a composite index (if you frequently query by question_id and survey_id together):
        $table->index(['question_id', 'survey_id']);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};

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
      Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->integer('step_number')->nullable();
        $table->enum('type', ['radio', 'rating', 'contact']);
        $table->boolean('hasTextarea')->default(true);
        $table->unsignedBigInteger('created_by');
        $table->foreign('created_by')->references('id')->on('users');
        $table->timestamps();


        $table->index('step_number');
        $table->index('type');
        $table->index('created_by');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

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
            $table->foreignId('examtest_id')->constrained('examtests')->cascadeOnDelete();
            $table->text('content');
            $table->enum('type', ['single','multiple','text']);
            $table->integer('position')->default(0);  // порядок вопросов
            $table->timestamps();

            $table->index(['examtest_id', 'position']);
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

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
        Schema::create('examtests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->enum('status', ['public','private','restricted'])->default('private');
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();

            // индексы для быстрого поиска
            $table->index(['category_id', 'author_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examtests');
    }
};

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
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            // Пользователь, который прошёл тест
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Ссылка на тест из таблицы examtests
            $table->foreignId('examtest_id')
                ->constrained('examtests')
                ->cascadeOnDelete();

            // Суммарные баллы (десятичная дробь)
            $table->decimal('score', 8, 4)->default(0);

            // Процент от максимума
            $table->unsignedTinyInteger('percent')->default(0);

            $table->unsignedSmallInteger('correct')->default(0);
            $table->unsignedSmallInteger('total')->default(0);
            $table->unsignedTinyInteger('grade')->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            // По желанию уникальность: одна попытка на момент времени
            $table->boolean('is_single_attempt')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};

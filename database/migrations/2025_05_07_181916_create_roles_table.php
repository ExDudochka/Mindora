<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // user, admin, moderator
            $table->string('display_name')->nullable();
            $table->timestamps();
        });

        // Сиды начальных ролей
        DB::table('roles')->insert([
            ['name' => 'user',      'display_name' => 'User',      'created_at' => now(), 'updated_at' => now()],
            ['name' => 'admin',     'display_name' => 'Admin',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'moderator', 'display_name' => 'Moderator', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

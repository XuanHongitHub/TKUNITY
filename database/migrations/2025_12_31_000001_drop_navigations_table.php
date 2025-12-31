<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('navigations');
    }

    public function down(): void
    {
        // Recreate navigations table if rolling back
        // Note: This is a simplified recreation - data will be lost
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle')->unique();
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }
};

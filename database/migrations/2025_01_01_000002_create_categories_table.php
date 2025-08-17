<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['income', 'expense']);
            $table->string('name');
            $table->string('color')->default('#64748b');
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'type', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};



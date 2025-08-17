<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['cash', 'bank', 'mobile_wallet', 'card', 'other']);
            $table->char('currency', 3)->default('EUR');
            $table->string('institution_name')->nullable();
            $table->string('account_number')->nullable();
            $table->decimal('opening_balance', 18, 2)->default(0);
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'account_number']);
            $table->index(['user_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};



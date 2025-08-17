<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obligation_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('obligation_id')->constrained('obligations')->cascadeOnDelete();
            $table->foreignUlid('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->decimal('amount', 18, 2);
            $table->timestamp('paid_at');
            $table->foreignUlid('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obligation_payments');
    }
};



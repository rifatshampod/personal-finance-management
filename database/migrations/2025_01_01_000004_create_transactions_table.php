<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->enum('type', ['income', 'expense', 'transfer']);
            $table->decimal('amount', 18, 2);
            $table->timestamp('occurred_at')->index();
            $table->foreignUlid('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignUlid('counterparty_id')->nullable()->constrained('counterparties')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->string('attachment_path')->nullable();
            $table->uuid('transfer_group')->nullable()->index();
            $table->foreignUlid('destination_account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};



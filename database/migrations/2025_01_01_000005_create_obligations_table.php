<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obligations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('counterparty_id')->constrained('counterparties')->cascadeOnDelete();
            $table->enum('direction', ['i_owe', 'owed_to_me']);
            $table->decimal('principal_amount', 18, 2);
            $table->char('currency', 3)->default('EUR');
            $table->string('purpose')->nullable();
            $table->enum('status', ['open', 'partial', 'settled'])->default('open');
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obligations');
    }
};



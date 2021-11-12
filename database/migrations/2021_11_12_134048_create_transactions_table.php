<?php

use App\Enums\TransactionStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained();
            $table->string('reference', 20);
            $table->string('card_number', 16);
            $table->foreignId('payment_method_id')->constrained();
            $table->unsignedBigInteger('total_amount');
            $table->foreignId('currency_id')->constrained();
            $table->enum('status', TransactionStatusEnum::STATUSES);
            $table->string('ip_address', 40);
            $table->string('payer', 255);
            $table->string('buyer', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}

<?php

use App\Constants\TransactionStatus;
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
            $table->foreignId('payer_id')->constrained('people');
            $table->foreignId('buyer_id')->constrained('people');
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->string('reference', 20);
            $table->string('card_number', 16);
            $table->unsignedBigInteger('total_amount');
            $table->enum('status', TransactionStatus::STATUSES);
            $table->string('ip_address', 40);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}

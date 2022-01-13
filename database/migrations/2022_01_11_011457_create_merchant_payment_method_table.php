<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantPaymentMethodTable extends Migration
{
    public function up(): void
    {
        Schema::create('merchant_payment_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->timestamp('enabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchant_payment_method');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('logo');
            $table->boolean('enabled')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
}

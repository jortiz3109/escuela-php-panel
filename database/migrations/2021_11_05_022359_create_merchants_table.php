<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('country_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->string('document', 30)->unique();
            $table->string('name', 120);
            $table->string('brand', 120);
            $table->string('url', 200)->nullable();
            $table->string('logo', 200)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
}

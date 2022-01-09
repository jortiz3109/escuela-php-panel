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
            $table->foreignId('document_type_id')->constrained();
            $table->string('document', 30);
            $table->string('name', 120)->index();
            $table->string('brand', 120)->index();
            $table->string('url')->nullable();
            $table->string('logo')->nullable();

            $table->index(['document', 'document_type_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
}

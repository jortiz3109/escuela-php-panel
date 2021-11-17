<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->tinyInteger('minor_unit');
            $table->string('alphabetic_code', 3);
            $table->string('numeric_code', 3);
            $table->timestamp('enabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('alpha_two_code', 2);
            $table->string('alpha_three_code', 3);
            $table->string('numeric_code', 3);
            $table->index('alpha_two_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}

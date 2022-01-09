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
            $table->char('alpha_two_code', 2)->unique();
            $table->char('alpha_three_code', 3)->unique();
            $table->char('numeric_code', 3)->unique();
            $table->timestamp('enabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}

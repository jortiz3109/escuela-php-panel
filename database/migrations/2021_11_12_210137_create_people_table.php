<?php

use App\Constants\PersonDocumentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('surname', 80);
            $table->enum('document_type', PersonDocumentType::DOCUMENT_TYPES);
            $table->string('document_number', 20);
            $table->string('email', 120);
            $table->string('mobile', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
}

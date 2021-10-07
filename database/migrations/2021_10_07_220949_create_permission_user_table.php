<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserTable extends Migration
{
    public function up(): void
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->unique(['user_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_user');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_user', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permission_id')->nullable();
            $table->timestamps();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_user');
    }
};

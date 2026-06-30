<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('token', 64);
            $table->string('activation_token', 64);
            $table->boolean('activation_token_used')->default(false);
            $table->timestamp('activation_expired_at')->nullable();
            $table->enum('status', ['active', 'nonactive'])->default('nonactive');
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_clients');
    }
};

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
        Schema::create('samsats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kendaraan_id')->constrained('kendaraans', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_samsat');
            $table->decimal('biaya', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samsats');
    }
};

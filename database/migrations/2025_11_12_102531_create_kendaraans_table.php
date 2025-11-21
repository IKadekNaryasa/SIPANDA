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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_barang', 50)->unique();
            $table->string('jenis_barang', 100);
            $table->string('merk_type', 50);
            $table->integer('cc');
            $table->integer('tahun_pembelian');
            $table->string('N_rangka', 50)->unique();
            $table->string('N_mesin', 50)->unique();
            $table->string('N_polisi', 50)->unique();
            $table->decimal('harga', 10, 0);
            $table->foreignUuid('user_id')->nullable()->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_jatuh_tempo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};

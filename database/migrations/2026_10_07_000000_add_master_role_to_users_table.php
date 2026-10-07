<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['operator', 'admin', 'pengawas', 'master'])
                ->default('operator')
                ->change();
        });
    }

    public function down(): void
    {
        if (DB::table('users')->where('role', 'master')->exists()) {
            throw new \RuntimeException('Cannot remove the master role while master users still exist.');
        }

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['operator', 'admin', 'pengawas'])
                ->default('operator')
                ->change();
        });
    }
};

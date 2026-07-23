<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('report_sales', function (Blueprint $table) {
            $table->dropColumn([
                'bogem_trx',
                'bogem_rev',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('report_sales', function (Blueprint $table) {
            $table->unsignedInteger('bogem_trx')->default(0);
            $table->unsignedBigInteger('bogem_rev')->default(0);
        });
    }
};
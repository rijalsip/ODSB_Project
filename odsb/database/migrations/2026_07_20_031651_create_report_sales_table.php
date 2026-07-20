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
        Schema::create('report_sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('site_id')
                ->nullable()
                ->constrained('sites')
                ->nullOnDelete();

            $table->date('report_date');

            // Renewal
            $table->integer('renewal_trx')->default(0);
            $table->bigInteger('renewal_rev')->default(0);

            // Voucher
            $table->integer('voucher_trx')->default(0);
            $table->bigInteger('voucher_rev')->default(0);

            // SA SP
            $table->integer('sa_sp_trx')->default(0);
            $table->bigInteger('sa_sp_rev')->default(0);

            // SA by.u
            $table->integer('sa_byu_trx')->default(0);
            $table->bigInteger('sa_byu_rev')->default(0);

            // MyTelkomsel
            $table->integer('mytelkomsel_trx')->default(0);

            // Halo
            $table->integer('halo_trx')->default(0);
            $table->bigInteger('halo_rev')->default(0);

            // Orbit
            $table->integer('orbit_trx')->default(0);
            $table->bigInteger('orbit_rev')->default(0);

            // Nomor Spesial
            $table->integer('nomor_spesial_trx')->default(0);
            $table->bigInteger('nomor_spesial_rev')->default(0);

            // Bogem
            $table->integer('bogem_trx')->default(0);
            $table->bigInteger('bogem_rev')->default(0);

            // Total
            $table->integer('total_trx')->default(0);
            $table->bigInteger('total_rev')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_sales');
    }
};
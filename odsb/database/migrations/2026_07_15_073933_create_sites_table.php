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
    Schema::create('sites', function (Blueprint $table) {

        $table->id();

        $table->string('site_id')->unique();
        $table->string('site_name');

        $table->string('branch')->nullable();
        $table->string('cluster')->nullable();
        $table->string('city')->nullable();

        // Status Site (NON, P1, P2, P3)
        $table->string('site_focus_mtd')->nullable();

        $table->string('kecamatan')->nullable();

        $table->string('program')->nullable();
        $table->string('detail_program_ssgj')->nullable();

        $table->string('new_infra')->nullable();
        $table->string('tech')->nullable();
        $table->string('class')->nullable();
        $table->string('ne')->nullable();

        $table->string('network_condition')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};

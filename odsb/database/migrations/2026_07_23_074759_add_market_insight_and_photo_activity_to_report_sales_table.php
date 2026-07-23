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
        Schema::table('report_sales', function (Blueprint $table) {
            $table->text('market_insight')->nullable()->after('total_rev');
            $table->longText('foto_activity')->nullable()->after('market_insight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_sales', function (Blueprint $table) {
            $table->dropColumn([
                'market_insight',
                'foto_activity',
            ]);
        });
    }
};
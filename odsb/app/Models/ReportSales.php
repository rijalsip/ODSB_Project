<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportSales extends Model
{
    protected $table = 'report_sales';

    protected $fillable = [
        'user_id',
        'site_id',
        'report_date',

        'renewal_trx',
        'renewal_rev',

        'voucher_trx',
        'voucher_rev',

        'sa_sp_trx',
        'sa_sp_rev',

        'sa_byu_trx',
        'sa_byu_rev',

        'mytelkomsel_trx',

        'halo_trx',
        'halo_rev',

        'orbit_trx',
        'orbit_rev',

        'nomor_spesial_trx',
        'nomor_spesial_rev',

        'bogem_trx',
        'bogem_rev',

        'total_trx',
        'total_rev',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    public function reportSales(): HasMany
{
    return $this->hasMany(ReportSales::class);
}
}
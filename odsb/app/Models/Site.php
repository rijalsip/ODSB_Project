<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'site_name',
        'branch',
        'cluster',
        'city',
        'site_focus_mtd',
        'kecamatan',
        'program',
        'detail_program_ssgj',
        'new_infra',
        'tech',
        'class',
        'ne',
        'network_condition',
    ];

    public function reportSales(): HasMany
    {
        return $this->hasMany(ReportSales::class);
    }
}
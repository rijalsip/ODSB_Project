<?php

namespace App\Services;

use App\Imports\SiteImport;
use App\Models\Site;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SiteService
{
    public function getPaginatedSites(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Site::query()
            ->latest()
            ->paginate($perPage);
    }

    public function createSite(array $data): Site
    {
        return DB::transaction(function () use ($data) {
            return Site::create($data);
        });
    }

    public function updateSite(
        Site $site,
        array $data
    ): Site {
        return DB::transaction(function () use ($site, $data) {

            $site->update($data);

            return $site->refresh();

        });
    }

    public function deleteSite(
        Site $site
    ): void {

        DB::transaction(function () use ($site) {

            $site->delete();

        });

    }

    public function importSite(
        UploadedFile $file
    ): void {

        DB::transaction(function () use ($file) {

            Excel::import(
                new SiteImport(),
                $file
            );

        });

    }
    /**
 * Cari Site berdasarkan ID.
 */
/**
 * Cari Site milik User.
 */
public function findUserSite(
    int $siteId,
    int $userId
): ?Site {

    return Site::query()
        ->where('id', $siteId)
        ->where('is_active', true)
        ->whereHas('users', function ($query) use ($userId) {

            $query->where('users.id', $userId);

        })
        ->first();

}
}
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
    /**
     * Menampilkan daftar Site dengan pagination.
     */
   public function getPaginatedSites(
    ?string $keyword = null,
    ?string $status = null,
    ?string $cluster = null,
    int $perPage = 10
): LengthAwarePaginator {

    return Site::query()

        ->when($keyword, function ($query) use ($keyword) {

            $query->where(function ($q) use ($keyword) {

                $q->where('site_id', 'like', "%{$keyword}%")
                  ->orWhere('site_name', 'like', "%{$keyword}%");

            });

        })

        ->when($status, function ($query) use ($status) {

            $query->where('site_focus_mtd', $status);

        })

        ->when($cluster, function ($query) use ($cluster) {

            $query->where('cluster', $cluster);

        })

        ->orderBy('site_id')

        ->paginate($perPage)

        ->withQueryString();

}
    /**
     * Menyimpan Site baru.
     */
    public function createSite(
        array $data
    ): Site {

        return DB::transaction(function () use ($data) {

            return Site::create($data);

        });

    }

    /**
     * Update Site.
     */
    public function updateSite(
        Site $site,
        array $data
    ): Site {

        return DB::transaction(function () use ($site, $data) {

            $site->update($data);

            return $site->refresh();

        });

    }

    /**
     * Hapus Site.
     */
    public function deleteSite(
        Site $site
    ): void {

        DB::transaction(function () use ($site) {

            $site->delete();

        });

    }

    /**
     * Import Site dari Excel.
     */
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
     * Cari Site berdasarkan Site ID.
     */
    public function findBySiteId(
        string $siteId
    ): ?Site {

        return Site::query()
            ->where('site_id', strtoupper(trim($siteId)))
            ->first();

    }
}
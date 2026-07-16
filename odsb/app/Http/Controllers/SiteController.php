<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\ImportSiteRequest;
use App\Http\Requests\Site\StoreSiteRequest;
use App\Http\Requests\Site\UpdateSiteRequest;
use App\Models\Site;
use App\Services\SiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class SiteController extends Controller
{
    public function __construct(
        private readonly SiteService $siteService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sites = $this->siteService
            ->getPaginatedSites();

        return view(
            'sites.index',
            compact('sites')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(
        StoreSiteRequest $request
    ): RedirectResponse {

        $this->siteService->createSite(
            $request->validated()
        );

        return redirect()
            ->route('sites.index')
            ->with(
                'success',
                'Site berhasil ditambahkan.'
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Site $site
    ): View {

        return view(
            'sites.edit',
            compact('site')
        );
    }

    /**
     * Update the specified resource.
     */
    public function update(
        UpdateSiteRequest $request,
        Site $site
    ): RedirectResponse {

        $this->siteService->updateSite(
            $site,
            $request->validated()
        );

        return redirect()
            ->route('sites.index')
            ->with(
                'success',
                'Site berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(
        Site $site
    ): RedirectResponse {

        try {

            $this->siteService->deleteSite(
                $site
            );

            return redirect()
                ->route('sites.index')
                ->with(
                    'success',
                    'Site berhasil dihapus.'
                );

        } catch (Throwable $exception) {

            return redirect()
                ->route('sites.index')
                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }

    /**
     * Import Excel
     */
    public function import(
        ImportSiteRequest $request
    ): RedirectResponse {

        try {

            $this->siteService->importSite(
                $request->file('file')
            );

            return redirect()
                ->route('sites.index')
                ->with(
                    'success',
                    'Data Site berhasil diimport.'
                );

        } catch (Throwable $exception) {

            return redirect()
                ->route('sites.index')
                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }
}
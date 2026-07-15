<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return response()->json(Site::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
            'site_name' => 'required',
            'rev_all' => 'required',
            'status' => 'required',
        ]);

        $site = Site::create($request->all());

        return response()->json([
            'message' => 'Site berhasil ditambahkan',
            'data' => $site
        ], 201);
    }

    public function show(Site $site)
    {
        return response()->json($site);
    }

    public function update(Request $request, Site $site)
    {
        $request->validate([
            'site_id' => 'required',
            'site_name' => 'required',
            'rev_all' => 'required',
            'status' => 'required',
        ]);

        $site->update($request->all());

        return response()->json([
            'message' => 'Site berhasil diubah',
            'data' => $site
        ]);
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json([
            'message' => 'Site berhasil dihapus'
        ]);
    }
}
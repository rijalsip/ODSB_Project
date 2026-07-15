<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $role = Role::create($request->all());

        return response()->json([
            'message' => 'Role berhasil ditambahkan',
            'data' => $role
        ], 201);
    }

    public function show(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $role->update($request->all());

        return response()->json([
            'message' => 'Role berhasil diubah',
            'data' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => 'Role berhasil dihapus'
        ]);
    }
}
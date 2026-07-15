<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'id_user' => 'required|string|unique:users,id_user',
            'role' => 'required|string',
        ]);

        $user = User::create($validated);

        return response()->json([
            'message' => 'User berhasil ditambahkan',
            'data' => $user
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'id_user' => 'required|string|unique:users,id_user,' . $user->id,
            'role' => 'required|string',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'User berhasil diubah',
            'data' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ]);
    }
}
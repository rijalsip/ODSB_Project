<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!$this->authService->login($request->validated(), $request)) {
            return back()
                ->withInput()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil.');
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return redirect()->route('login');
    }
    
} 

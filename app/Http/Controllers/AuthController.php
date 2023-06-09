<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $service;
    public function __construct(AuthService $_service)
    {
        $this->service = $_service;
    }
    public function login()
    {
        return view('pages.auth-login');
    }
    public function me(Request $request)
    {
        return $this->service->me($request);
    }
    public function authenticate(LoginRequest $request)
    {
        return $this->service->authenticate($request);
    }
    public function logout(Request $request)
    {
        return $this->service->logout($request);
    }
}

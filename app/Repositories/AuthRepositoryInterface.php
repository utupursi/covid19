<?php

namespace App\Repositories;

use App\Http\Request\LoginRequest;

use App\Http\Request\RegisterRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $request);

    public function register(RegisterRequest $request);
}

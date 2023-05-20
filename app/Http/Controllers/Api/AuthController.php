<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $this->service->login($validated);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $user = auth()->user();
        $token = $user->createToken('API Token of '.$user->username)->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->success($data, 'A user logged successfully');
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $photo = $request->file('photo');

        try {
            $user = $this->service->registerAuthor($validated, $photo);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        $token = $user->createToken('API Token of '.$user->username)->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->success($data, 'A new user added successfully', 201);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        try {
            $this->service->logout($user);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success([], 'A user logged out successfully');
    }
}

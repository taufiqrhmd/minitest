<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    use HttpResponses;

    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->cant('viewAny', User::class)) {
            return $this->error('Forbidden', 403);
        }

        $userId = auth()->id();

        try {
            $user = $this->service->findUser($userId);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($user, 'This is your Profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->user()->cant('update', $user)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validated();
        $photo = $request->file('photo');

        try {
            $user = $this->service->changeUser($validated, $photo, $user);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($user, 'This is your updated profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function password(UpdateUserRequest $request, User $user)
    {
        if ($request->user()->cant('update', $user)) {
            return $this->error('Forbidden', 403);
        }

        $validated = $request->validate([
            'current_password' => 'required|current_password:api',
            'password' => [
                'sometimes',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        try {
            $user = $this->service->changePassword($validated, $user);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($user, 'This is your updated profile');
    }
}

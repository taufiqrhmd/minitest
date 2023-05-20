<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService.
 */
class UserService
{
    /**
     * Get all users
     */
    public static function findAllUsers(): Collection
    {
        $users = User::all();

        return $users;
    }

    /**
     * Get a authenticated user
     */
    public static function findUser(string $user_id): User
    {
        $user = User::findOrFail($user_id);

        return $user;
    }

    /**
     * Get a user
     */
    public static function findUserById(User $user): User
    {
        $user->load(['stories' => function ($query) {
            $query->with(['category', 'like'])->withCount(['episodes', 'likes', 'comments']);
        }]);

        return $user;
    }

    /**
     * Edit a user
     *
     * @param  UploadedFile  $photo
     */
    public static function changeUser(array $request, ?UploadedFile $photo, User $user): User
    {
        if ($photo) {
            if ($user->photo) {
                Storage::move($user->photo, $photo);
            }

            $request['photo'] = $photo->store('photo');
        }

        $user->updateOrFail($request);

        return $user;
    }

    /**
     * Edit user's password
     */
    public static function changePassword(array $request, User $user): User
    {
        $user->updateOrFail([
            'password' => bcrypt($request['password']),
        ]);

        return $user;
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user): bool
    {
        Storage::delete($user->picture);

        return $user->deleteOrFail();
    }
}

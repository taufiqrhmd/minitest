<?php

namespace App\Traits;

use App\Models\User;

trait CreateUser
{
    protected function createUser(): User
    {
        return User::factory()->create();
    }
}

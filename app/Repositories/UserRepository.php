<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    public function all()
    {
        return User::all();
    }

    public function update(array $data, $id)
    {

    }
}


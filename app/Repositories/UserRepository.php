<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday_of_date' => $data['birthday_of_date'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function update(int $id, array $data)
    {
        $user = $this->find($id);

        return $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday_of_date' => $data['birthday_of_date'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function get()
    {
        return User::get();
    }

    public function delete(int $id)
    {
        $user = $this->find($id);

        return $user->delete();
    }
}


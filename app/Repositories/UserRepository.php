<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birth_of_date' => $data['birth_of_date'],
            'phone_number' => $data['phone_number'],
            'password' => $data['password'],
            'role' => $data['role'],
            'district_id' => $data['district_id']
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
            'birth_of_date' => $data['birth_of_date'],
            'phone_number' => $data['phone_number'],
            'password' => $data['password'],
            'role' => $data['role'],
            'district_id' => $data['district_id']
        ]);
    }

    public function get(string $text, int $page, int $per_page, $district_id, $region_id, string $role)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $user = User::where('name', 'LIKE', '%'.$text.'%');

        if($district_id != null)
            $user->where('district_id', $district_id);

        if($region_id != null)
            $user->where('region_id', $region_id);

        if($role != "")
            $user->where('role', $role);

        return $user->paginate($per_page);
    }

    public function delete(int $id)
    {
        $user = $this->find($id);

        return $user->delete();
    }
}


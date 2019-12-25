<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface UserServiceInterface
{

    public function get(Request $request);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

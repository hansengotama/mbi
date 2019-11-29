<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function all();
    public function update(array $data, $id);
}

<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function create(array $data);
    public function get();
    public function update(int $id, array $data);
    public function find(int $id);
    public function delete(int $id);
}

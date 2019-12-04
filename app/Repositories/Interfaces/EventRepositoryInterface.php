<?php

namespace App\Repositories\Interfaces;

interface EventRepositoryInterface
{

    public function get();
    public function create(array $data);
    public function update(int $id, array $data);
    public function find(int $id);
    public function delete(int $id);
}

<?php

namespace App\Repositories\Interfaces;

interface DeceasedRepositoryInterface
{

    public function get();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

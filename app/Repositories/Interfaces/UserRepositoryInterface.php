<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    public function create(array $data);
    public function get(string $text, int $page, int $per_page, $district_id, $region_id, string $role);
    public function update(int $id, array $data);
    public function find(int $id);
    public function delete(int $id);
}

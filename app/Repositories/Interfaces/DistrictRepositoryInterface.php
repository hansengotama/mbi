<?php

namespace App\Repositories\Interfaces;

interface DistrictRepositoryInterface
{

    public function get(string $text, int $page, int $per_page);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

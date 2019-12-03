<?php

namespace App\Repositories;

use App\Models\Region;
use App\Repositories\Interfaces\RegionRepositoryInterface;

class RegionRepository implements RegionRepositoryInterface {

    public function get()
    {
        return Region::get();
    }

    public function create(array $data)
    {
        return Region::create([
            'name' => $data['name']
        ]);
    }

    public function update(int $id, array $data)
    {
        $region = $this->find($id);

        return $region->update([
            'name' => $data['name']
        ]);
    }

    public function find(int $id)
    {
        return Region::find($id);
    }

    public function delete(int $id)
    {
        $region = $this->find($id);

        return $region->delete();
    }
}

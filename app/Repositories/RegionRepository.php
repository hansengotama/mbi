<?php

namespace App\Repositories;

use App\Models\Region;
use App\Repositories\Interfaces\RegionRepositoryInterface;
use Illuminate\Pagination\Paginator;

class RegionRepository implements RegionRepositoryInterface {

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Region::where('name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function create(array $data)
    {
        return Region::create([
            'name' => $data['name'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $region = $this->find($id);

        return $region->update([
            'name' => $data['name'],
            'district_id' => $data['district_id']
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

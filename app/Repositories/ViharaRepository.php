<?php

namespace App\Repositories;

use App\Models\Vihara;
use App\Repositories\Interfaces\ViharaRepositoryInterface;
use Illuminate\Pagination\Paginator;

class ViharaRepository implements ViharaRepositoryInterface {

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Vihara::where('name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function find(int $id)
    {
        return Vihara::find($id);
    }

    public function create(array $data)
    {
        return Vihara::create([
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $vihara = $this->find($id);

        return $vihara->update([
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'district_id' => $data['district_id']
        ]);
    }

    public function delete($id)
    {
        $vihara = $this->find($id);

        return $vihara->delete();
    }
}

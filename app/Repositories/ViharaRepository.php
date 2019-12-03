<?php

namespace App\Repositories;

use App\Models\Vihara;
use App\Repositories\Interfaces\ViharaRepositoryInterface;

class ViharaRepository implements ViharaRepositoryInterface {

    public function get()
    {
        return Vihara::get();
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
            'address' => $data['address']
        ]);
    }

    public function update(int $id, array $data)
    {
        $vihara = $this->find($id);

        return $vihara->update([
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address']
        ]);
    }

    public function delete($id)
    {
        $vihara = $this->find($id);

        return $vihara->delete();
    }
}

<?php

namespace App\Repositories;

use App\Models\Pandita;
use App\Repositories\Interfaces\PanditaRepositoryInterface;

class PanditaRepository implements PanditaRepositoryInterface
{

    public function get()
    {
        return Pandita::get();
    }

    public function find(int $id)
    {
        return Pandita::find($id);
    }

    public function create(array $data)
    {
        return Pandita::create([
            'name' => $data['name'],
            'vihara_id' => $data['vihara_id'],
            'phone_number' => $data['phone_number']
        ]);
    }

    public function update(int $id, array $data)
    {
        $pandita = $this->find($id);

        return $pandita->update([
            'name' => $data['name'],
            'vihara_id' => $data['vihara_id'],
            'phone_number' => $data['phone_number']
        ]);
    }

    public function delete(int $id)
    {
        $pandita = $this->find($id);

        return $pandita->delete();
    }
}

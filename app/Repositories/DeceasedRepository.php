<?php

namespace App\Repositories;

use App\Models\Deceased;
use App\Repositories\Interfaces\DeceasedRepositoryInterface;
use Illuminate\Pagination\Paginator;

class DeceasedRepository implements DeceasedRepositoryInterface
{

    public function get(string $text, int $page, int $per_page, $district_id, $region_id)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $deceased = Deceased::where('name', 'LIKE', '%'.$text.'%');

        if($district_id != null)
            $deceased->where("district_id", $district_id);

        if($region_id != null)
            $deceased->where("region_id", $region_id);

        return $deceased->paginate($per_page);
    }

    public function find(int $id)
    {
        return Deceased::find($id);
    }

    public function create(array $data)
    {
        return Deceased::create([
            'name' => $data['name'],
            'photo_url' => $data['photo_url'],
            'region_id' => $data['region_id'],
            'close_age' => $data['close_age'],
            'buried_date' => $data['buried_date'],
            'deceased_date' => $data['deceased_date'],
            'buried_at' => $data['buried_at'],
            'type' => $data['type'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $deceased = $this->find($id);

        return $deceased->update([
            'name' => $data['name'],
            'photo_url' => $data['photo_url'],
            'region_id' => $data['region_id'],
            'close_age' => $data['close_age'],
            'buried_date' => $data['buried_date'],
            'deceased_date' => $data['deceased_date'],
            'buried_at' => $data['buried_at'],
            'type' => $data['type'],
            'district_id' => $data['district_id']
        ]);
    }

    public function delete(int $id)
    {
        $deceased = $this->find($id);

        return $deceased->delete();
    }
}

<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Pagination\Paginator;

class EventRepository implements EventRepositoryInterface
{

    public function get(string $text, int $page, int $per_page, $district_id, $region_id)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $event = Event::where('name', 'LIKE', '%'.$text.'%');

        if($district_id != null)
            $event->where("district_id", $district_id);

        if($region_id != null)
            $event->where("region_id", $region_id);

        return $event->paginate($per_page);
    }

    public function create(array $data)
    {
        return Event::create([
            'name' => $data['name'],
            'vihara_id' => $data['vihara_id'],
            'description' => $data['description'],
            'address' => $data['address'],
            'poster_url' => $data['poster_url'],
            'district_id' => $data['district_id'],
            'region_id' => $data['region_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $event = $this->find($id);

        return $event->update([
            'name' => $data['name'],
            'vihara_id' => $data['vihara_id'],
            'description' => $data['description'],
            'address' => $data['address'],
            'poster_url' => $data['poster_url'],
            'district_id' => $data['district_id'],
            'region_id' => $data['region_id']
        ]);
    }

    public function find(int $id)
    {
        return Event::find($id);
    }

    public function delete(int $id)
    {
        $event = $this->find($id);

        return $event->delete();
    }
}

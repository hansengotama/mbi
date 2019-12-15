<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Pagination\Paginator;

class EventRepository implements EventRepositoryInterface
{

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Event::where('name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function create(array $data)
    {
        return Event::create([
            'name' => $data['name'],
            'vihara_id' => $data['vihara_id'],
            'description' => $data['description'],
            'address' => $data['address'],
            'poster_url' => $data['poster_url']
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
            'poster_url' => $data['poster_url']
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

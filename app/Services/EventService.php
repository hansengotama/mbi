<?php

namespace App\Services;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventService implements EventServiceInterface
{

    private $eventRepository;

    function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['vihara_id'] = $request['vihara_id'];
        $formData['description'] = $request['description'];
        $formData['address'] = $request['address'];
        $formData['poster_url'] = $request['poster_url'];
        $formData['district_id'] = $request['district_id'];
        $formData['region_id'] = $request['region_id'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->eventRepository->get($text, $page, $per_page);
    }

    public function find(int $id)
    {
        return $this->eventRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->eventRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->eventRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->eventRepository->delete($id);
    }
}

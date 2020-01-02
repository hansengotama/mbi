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
        $formData['detail'] = $request['detail'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = (!isset($filter['text'])) ? "" : $filter['text'];
        $page = (!isset($filter['page'])) ? 1 : (int)$filter['page'];
        $per_page = (!isset($filter['per_page'])) ? 10 : (int)$filter['per_page'];
        $district_id = (!isset($filter['district_id'])) ? null : (int)$filter['district_id'];
        $region_id = (!isset($filter['region_id'])) ? null : (int)$filter['region_id'];

        return $this->eventRepository->get($text, $page, $per_page, $district_id, $region_id);
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

<?php

namespace App\Services;

use App\Repositories\Interfaces\RegionRepositoryInterface;
use App\Services\Interfaces\RegionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionService implements RegionServiceInterface
{

    private $regionRepository;

    function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['district_id'] = $request['district_id'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = (!isset($filter['text'])) ? "" : $filter['text'];
        $page = (!isset($filter['page'])) ? 1 : (int)$filter['page'];
        $per_page = (!isset($filter['per_page'])) ? 10 : (int)$filter['per_page'];
        $district_id = (!isset($filter['district_id'])) ? null : (int)$filter['district_id'];

        return $this->regionRepository->get($text, $page, $per_page, $district_id);
    }

    public function find(int $id)
    {
        return $this->regionRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->regionRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->regionRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $data = $this->regionRepository->delete($id);
    }
}

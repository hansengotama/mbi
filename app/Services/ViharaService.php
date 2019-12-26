<?php

namespace App\Services;

use App\Repositories\Interfaces\ViharaRepositoryInterface;
use App\Services\Interfaces\ViharaServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViharaService implements ViharaServiceInterface {

    private $viharaRepository;

    function __construct(ViharaRepositoryInterface $viharaRepository)
    {
        $this->viharaRepository = $viharaRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['region_id'] = $request['region_id'];
        $formData['phone_number'] = $request['phone_number'];
        $formData['address'] = $request['address'];
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
        $region_id = (!isset($filter['region_id'])) ? null : (int)$filter['region_id'];

        return $this->viharaRepository->get($text, $page, $per_page, $district_id, $region_id);
    }

    public function find(int $id)
    {
        return $this->viharaRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->viharaRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());
        return $this->viharaRepository->update($id, $formData);
    }

    public function delete($id)
    {
        return $this->viharaRepository->delete($id);
    }
}

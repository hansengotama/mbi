<?php

namespace App\Services;

use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Services\Interfaces\DistrictServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictService implements DistrictServiceInterface
{

    private $districtRepository;
    private $userService;

    function __construct(DistrictRepositoryInterface $districtRepository, UserServiceInterface $userService)
    {
        $this->districtRepository = $districtRepository;
        $this->userService = $userService;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['account_number_1'] = $request['account_number_1'];
        $formData['account_number_2'] = isset($request['account_number_2']) ? $request['account_number_2'] : null;
        $formData['account_name_1'] = $request['account_name_1'];
        $formData['account_name_2'] = isset($request['account_name_2']) ? $request['account_name_2'] : null;
        $formData['bank_name_1'] = $request['bank_name_1'];
        $formData['bank_name_2'] = isset($request['bank_name_2']) ? $request['bank_name_2'] : null;

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->districtRepository->get($text, $page, $per_page);
    }

    public function find(int $id)
    {
        return $this->districtRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->districtRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->districtRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->districtRepository->delete($id);
    }
}

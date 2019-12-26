<?php

namespace App\Services;

use App\Repositories\Interfaces\RequestKtubRepositoryInterface;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestKtubService implements RequestKtubServiceInterface {

    private $requestKtubRepository;

    function __construct(RequestKtubRepositoryInterface $requestKtubRepository)
    {
        $this->requestKtubRepository = $requestKtubRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['user_id'] = Auth::id();
        $formData['id_number'] = $request['id_number'];
        $formData['family_card_number'] = $request['family_card_number'];
        $formData['last_education'] = $request['last_education'];
        $formData['photo_url'] = $request['photo_url'];
        $formData['visudhi_name'] = $request['visudhi_name'];
        $formData['visudhi_place'] = $request['visudhi_place'];
        $formData['visudhi_teacher'] = $request['visudhi_teacher'];
        $formData['visudhi_role'] = $request['visudhi_role'];
        $formData['business_name'] = $request['business_name'];
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

        return $this->requestKtubRepository->get($text, $page, $per_page, $district_id);
    }

    public function find(int $id)
    {
        return $this->requestKtubRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->requestKtubRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->requestKtubRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->requestKtubRepository->delete($id);
    }
}

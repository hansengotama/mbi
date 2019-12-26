<?php

namespace App\Services;

use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationService implements DonationServiceInterface {

    private $donationRepository;

    function __construct(DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['donors_name'] = $request['donors_name'];
        $formData['amount'] = $request['amount'];
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

        return $this->donationRepository->get($text, $page, $per_page, $district_id);
    }

    public function find(int $id)
    {
        return $this->donationRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->donationRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->donationRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->donationRepository->delete($id);
    }
}

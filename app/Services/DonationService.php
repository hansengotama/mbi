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

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->donationRepository->get($text, $page, $per_page);
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

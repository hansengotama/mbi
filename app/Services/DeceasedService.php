<?php

namespace App\Services;

use App\Repositories\Interfaces\DeceasedRepositoryInterface;
use App\Services\Interfaces\DeceasedServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeceasedService implements DeceasedServiceInterface
{

    private $deceasedRepository;

    function __construct(DeceasedRepositoryInterface $deceasedRepository)
    {
        $this->deceasedRepository = $deceasedRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['photo_url'] = $request['photo_url'];
        $formData['region_id'] = $request['region_id'];
        $formData['district_id'] = $request['district_id'];
        $formData['close_age'] = $request['close_age'];
        $formData['buried_date'] = Carbon::parse($request['buried_date'])->format('Y-m-d H:i:s');
        $formData['deceased_date'] = Carbon::parse($request['deceased_date'])->format('Y-m-d H:i:s');
        $formData['buried_at'] = $request['buried_at'];
        $formData['type'] = $request['type'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->deceasedRepository->get($text, $page, $per_page);
    }

    public function find(int $id)
    {
        return $this->deceasedRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->deceasedRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->deceasedRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->deceasedRepository->delete($id);
    }
}

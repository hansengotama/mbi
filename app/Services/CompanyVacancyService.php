<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyVacancyRepositoryInterface;
use App\Services\Interfaces\CompanyVacancyServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyVacancyService implements CompanyVacancyServiceInterface
{

    private $companyVacancyRepository;

    function __construct(CompanyVacancyRepositoryInterface $companyVacancyRepository)
    {
        $this->companyVacancyRepository = $companyVacancyRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['district_id'] = $request['district_id'];
        $formData['name'] = $request['name'];
        $formData['logo_url'] = $request['logo_url'];
        $formData['city'] = $request['city'];
        $formData['position'] = $request['position'];
        $formData['field'] = $request['field'];
        $formData['detail'] = $request['detail'];
        $formData['from'] = Carbon::parse($request['from'])->format('Y-m-d H:i:s');
        $formData['until'] = Carbon::parse($request['until'])->format('Y-m-d H:i:s');
        $formData['pic_name'] = $request['pic_name'];
        $formData['pic_email'] = $request['pic_email'];
        $formData['pic_phone_number'] = $request['pic_phone_number'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = (!isset($filter['text'])) ? "" : $filter['text'];
        $page = (!isset($filter['page'])) ? 1 : (int)$filter['page'];
        $per_page = (!isset($filter['per_page'])) ? 10 : (int)$filter['per_page'];
        $district_id = (!isset($filter['district_id'])) ? null : (int)$filter['district_id'];

        return $this->companyVacancyRepository->get($text, $page, $per_page, $district_id);
    }

    public function find(int $id)
    {
        return $this->companyVacancyRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->companyVacancyRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->companyVacancyRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $data = $this->companyVacancyRepository->delete($id);
    }
}

<?php

namespace App\Repositories;

use App\Models\CompanyVacancy;
use App\Repositories\Interfaces\CompanyVacancyRepositoryInterface;
use Illuminate\Pagination\Paginator;

class CompanyVacancyRepository implements CompanyVacancyRepositoryInterface {

    public function get(string $text, int $page, int $per_page, $district_id)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $companyVacancy = CompanyVacancy::where('name', 'LIKE', '%'.$text.'%');

        if($district_id != null)
            $companyVacancy->where("district_id", $district_id);

        return $companyVacancy->paginate($per_page);
    }

    public function find(int $id)
    {
        return CompanyVacancy::find($id);
    }

    public function create(array $data)
    {
        return CompanyVacancy::create([
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'logo_url' => $data['logo_url'],
            'city' => $data['city'],
            'position' => $data['position'],
            'field' => $data['field'],
            'detail' => $data['detail'],
            'from' => $data['from'],
            'until' => $data['until'],
            'pic_name' => $data['pic_name'],
            'pic_email' => $data['pic_email'],
            'pic_phone_number' => $data['pic_phone_number'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $companyVacancy = $this->find($id);

        return $companyVacancy->update([
            'region_id' => $data['region_id'],
            'name' => $data['name'],
            'logo_url' => $data['logo_url'],
            'city' => $data['city'],
            'position' => $data['position'],
            'field' => $data['field'],
            'detail' => $data['detail'],
            'from' => $data['from'],
            'until' => $data['until'],
            'pic_name' => $data['pic_name'],
            'pic_email' => $data['pic_email'],
            'pic_phone_number' => $data['pic_phone_number'],
            'district_id' => $data['district_id']
        ]);
    }

    public function delete(int $id)
    {
        $companyVacancy = $this->find($id);

        return $companyVacancy->delete();
    }
}

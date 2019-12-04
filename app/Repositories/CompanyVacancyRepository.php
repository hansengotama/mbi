<?php

namespace App\Repositories;

use App\Models\CompanyVacancy;
use App\Repositories\Interfaces\CompanyVacancyRepositoryInterface;

class CompanyVacancyRepository implements CompanyVacancyRepositoryInterface {

    public function get()
    {
        return CompanyVacancy::get();
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
        ]);
    }

    public function delete(int $id)
    {
        $companyVacancy = $this->find($id);

        return $companyVacancy->delete();
    }
}

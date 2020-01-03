<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use Illuminate\Pagination\Paginator;

class DistrictRepository implements DistrictRepositoryInterface
{

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return District::where('name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function find(int $id)
    {
        return District::find($id);
    }

    public function create(array $data)
    {
        return District::create([
            'name' => $data['name'],
            'account_number_1' => $data['account_number_1'],
            'account_number_2' => $data['account_number_2'],
            'account_name_1' => $data['account_name_1'],
            'account_name_2' => $data['account_name_2'],
            'bank_name_1' => $data['bank_name_1'],
            'bank_name_2' => $data['bank_name_2']
        ]);
    }

    public function update(int $id, array $data)
    {
        $district = $this->find($id);

        return $district->update([
            'name' => $data['name'],
            'account_number_1' => $data['account_number_1'],
            'account_number_2' => $data['account_number_2'],
            'account_name_1' => $data['account_name_1'],
            'account_name_2' => $data['account_name_2'],
            'bank_name_1' => $data['bank_name_1'],
            'bank_name_2' => $data['bank_name_2']
        ]);
    }

    public function delete(int $id)
    {
        $district = $this->find($id);

        return $district->delete();
    }
}

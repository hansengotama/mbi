<?php

namespace App\Repositories;

use App\Models\RequestKtub;
use App\Repositories\Interfaces\RequestKtubRepositoryInterface;
use Illuminate\Pagination\Paginator;

class RequestKtubRepository implements RequestKtubRepositoryInterface {

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return RequestKtub::where('visudhi_name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function find(int $id)
    {
        return RequestKtub::find($id);
    }

    public function create(array $data)
    {
        return RequestKtub::create([
            'user_id' => $data['user_id'],
            'id_number' => $data['id_number'],
            'family_card_number' => $data['family_card_number'],
            'last_education' => $data['last_education'],
            'photo_url' => $data['photo_url'],
            'visudhi_name' => $data['visudhi_name'],
            'visudhi_place' => $data['visudhi_place'],
            'visudhi_teacher' => $data['visudhi_teacher'],
            'visudhi_role' => $data['visudhi_role'],
            'business_name' => $data['business_name'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $requestKtub = $this->find($id);

        return $requestKtub->update([
            'user_id' => $data['user_id'],
            'id_number' => $data['id_number'],
            'family_card_number' => $data['family_card_number'],
            'last_education' => $data['last_education'],
            'photo_url' => $data['photo_url'],
            'visudhi_name' => $data['visudhi_name'],
            'visudhi_place' => $data['visudhi_place'],
            'visudhi_teacher' => $data['visudhi_teacher'],
            'visudhi_role' => $data['visudhi_role'],
            'business_name' => $data['business_name'],
            'district_id' => $data['district_id']
        ]);
    }

    public function delete(int $id)
    {
        $requestKtub = $this->find($id);

        return $requestKtub->delete();
    }
}

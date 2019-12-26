<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use Illuminate\Pagination\Paginator;

class DonationRepository implements DonationRepositoryInterface {

    public function get(string $text, int $page, int $per_page, $district_id)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $donation = Donation::where('donors_name', 'LIKE', '%'.$text.'%');

        if($district_id != null)
            $donation->where("district_id", $district_id);

        return $donation->paginate($per_page);
    }

    public function find(int $id)
    {
        return Donation::find($id);
    }

    public function create(array $data)
    {
        return Donation::create([
            'donors_name' => $data['donors_name'],
            'amount' => $data['amount'],
            'district_id' => $data['district_id']
        ]);
    }

    public function update(int $id, array $data)
    {
        $donation = $this->find($id);

        return $donation->update([
            'donors_name' => $data['donors_name'],
            'amount' => $data['amount'],
            'district_id' => $data['district_id']
        ]);
    }

    public function delete(int $id)
    {
        $donation = $this->find($id);

        return $donation->delete();
    }
}

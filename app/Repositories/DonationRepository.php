<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use Illuminate\Pagination\Paginator;

class DonationRepository implements DonationRepositoryInterface {

    public function get(string $text, int $page, int $per_page)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return Donation::where('donors_name', 'LIKE', '%'.$text.'%')->paginate($per_page);
    }

    public function find(int $id)
    {
        return Donation::find($id);
    }

    public function create(array $data)
    {
        return Donation::create([
            'donors_name' => $data['donors_name'],
            'amount' => $data['amount']
        ]);
    }

    public function update(int $id, array $data)
    {
        $donation = $this->find($id);

        return $donation->update([
            'donors_name' => $data['donors_name'],
            'amount' => $data['amount']
        ]);
    }

    public function delete(int $id)
    {
        $donation = $this->find($id);

        return $donation->delete();
    }
}

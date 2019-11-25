<?php

namespace App\Services;

use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;

class DonationService implements DonationServiceInterface {

    private $donationRepository;

    function __construct(DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function create(Request $request)
    {

    }
}

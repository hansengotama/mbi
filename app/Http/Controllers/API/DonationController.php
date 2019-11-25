<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    private $donationService;

    function __construct(DonationServiceInterface $donationService)
    {
        $this->donationService = $donationService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

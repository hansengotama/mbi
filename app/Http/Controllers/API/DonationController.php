<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    private $donationService;

    function __construct(DonationServiceInterface $donationService)
    {
        $this->donationService = $donationService;
    }

    public function create(Request $request)
    {

    }
}

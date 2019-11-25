<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DeceasedServiceInterface;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{
    private $deceasedService;

    function __construct(DeceasedServiceInterface $deceasedService)
    {
        $this->deceasedService = $deceasedService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

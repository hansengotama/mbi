<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\RegionServiceInterface;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private $regionService;

    function __construct(RegionServiceInterface $regionService)
    {
        $this->regionService = $regionService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

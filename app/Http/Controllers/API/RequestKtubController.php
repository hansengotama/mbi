<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;

class RequestKtubController extends Controller
{
    private $requestKtubService;

    function __construct(RequestKtubServiceInterface $requestKtubService)
    {
        $this->requestKtubService = $requestKtubService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

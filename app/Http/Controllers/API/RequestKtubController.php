<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;

class RequestKtubController extends Controller
{

    private $requestKtubService;

    function __construct(RequestKtubServiceInterface $requestKtubService)
    {
        $this->requestKtubService = $requestKtubService;
    }

    public function create(Request $request)
    {

    }
}

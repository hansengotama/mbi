<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\ViharaServiceInterface;
use Illuminate\Http\Request;

class ViharaController extends Controller
{
    private $viharaService;

    function __construct(ViharaServiceInterface $viharaService)
    {
        $this->viharaService = $viharaService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

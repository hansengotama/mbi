<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;

class PanditaController extends Controller
{
    private $panditaService;

    function __construct(PanditaServiceInterface $panditaService)
    {
        $this->panditaService = $panditaService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

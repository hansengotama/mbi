<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;

class PanditaController extends Controller
{

    private $panditaService;

    function __construct(PanditaServiceInterface $panditaService)
    {
        $this->panditaService = $panditaService;
    }

    public function create(Request $request)
    {

    }
}

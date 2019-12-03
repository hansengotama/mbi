<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DeceasedServiceInterface;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{

    private $deceasedService;

    function __construct(DeceasedServiceInterface $deceasedService)
    {
        $this->deceasedService = $deceasedService;
    }

    public function create(Request $request)
    {

    }
}

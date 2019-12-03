<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{

    private $eventService;

    function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    public function create(Request $request)
    {

    }
}

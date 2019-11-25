<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $eventService;

    function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
        $this->apiHelper = new ApiHelper();
    }

    public function create(Request $request)
    {

    }
}

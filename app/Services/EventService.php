<?php

namespace App\Services;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;

class EventService implements EventServiceInterface {

    private $eventRepository;

    function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function create(Request $request)
    {

    }
}

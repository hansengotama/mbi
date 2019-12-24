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

    public function get(Request $request)
    {
        $data = $this->eventService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->eventService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->eventService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->eventService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->eventService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

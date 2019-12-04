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

    public function get()
    {
        $data = $this->deceasedService->get();

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->deceasedService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->deceasedService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->deceasedService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->deceasedService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

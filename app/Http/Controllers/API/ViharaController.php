<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\ViharaServiceInterface;
use Illuminate\Http\Request;

class ViharaController extends Controller
{

    private $viharaService;

    function __construct(ViharaServiceInterface $viharaService)
    {
        $this->viharaService = $viharaService;
    }

    public function get()
    {
        $data = $this->viharaService->get();

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->viharaService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->viharaService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->viharaService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->viharaService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

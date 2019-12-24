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

    public function get(Request $request)
    {
        $data = $this->panditaService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->panditaService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->panditaService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->panditaService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->panditaService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

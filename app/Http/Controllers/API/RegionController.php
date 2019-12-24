<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\RegionServiceInterface;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    private $regionService;

    function __construct(RegionServiceInterface $regionService)
    {
        $this->regionService = $regionService;
    }

    public function get(Request $request)
    {
        $data = $this->regionService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->regionService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->regionService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->regionService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->regionService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

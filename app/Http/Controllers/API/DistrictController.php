<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DistrictServiceInterface;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    private $districtService;

    function __construct(DistrictServiceInterface $districtService)
    {
        $this->districtService = $districtService;
    }

    public function get(Request $request)
    {
        $data = $this->districtService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->districtService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->districtService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->districtService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->districtService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

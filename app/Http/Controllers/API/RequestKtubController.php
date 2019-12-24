<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;

class RequestKtubController extends Controller
{

    private $requestKtubService;

    function __construct(RequestKtubServiceInterface $requestKtubService)
    {
        $this->requestKtubService = $requestKtubService;
    }

    public function get(Request $request)
    {
        $data = $this->requestKtubService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->requestKtubService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->requestKtubService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->requestKtubService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->requestKtubService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

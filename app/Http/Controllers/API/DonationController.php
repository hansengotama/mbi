<?php

namespace App\Http\Controllers\API;

use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    private $donationService;

    function __construct(DonationServiceInterface $donationService)
    {
        $this->donationService = $donationService;
    }

    public function get()
    {
        $data = $this->donationService->get();

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->donationService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->donationService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->donationService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->donationService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

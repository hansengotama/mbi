<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
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

    private function checkDonationNull(int $id)
    {
        $data = $this->donationService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseDonationNull()
    {
        return [
            'message' => $message = 'Donation not Found',
            'code' => $code = 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->donationService->get($request);

        return api_response(true, 200, 'Get Donation', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkDonationNull = $this->checkDonationNull($id);
        if($checkDonationNull) return $this->responseDonationNull();
        else {
            $data = $this->donationService->find($id);

            return api_response(true, 200, 'Donation Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donors_name' => 'required',
            'amount' => 'required',
            'district_id' => 'required|exists:districts,id'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->donationService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Donation Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkDonationNull = $this->checkDonationNull($id);
        if($checkDonationNull) return $this->responseDonationNull();
        else {
            $validator = Validator::make($request->all(), [
                'donors_name' => 'required',
                'amount' => 'required',
                'district_id' => 'required|exists:districts,id'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            }else {
                $data = $this->donationService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Donation Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkDonationNull = $this->checkDonationNull($id);
        if($checkDonationNull) return $this->responseDonationNull();
        else {
            $data = $this->donationService->delete($id);

            return api_response(true, 200, 'Donation Deleted', $data);
        }
    }
}

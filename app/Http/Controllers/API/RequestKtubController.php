<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
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

    private function checkRequestKtubNull(int $id)
    {
        $data = $this->requestKtubService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseRequestKtubNull()
    {
        return [
            'message' => 'Request Ktub not Found',
            'code' => 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->requestKtubService->get($request);

        return api_response(true, 200, 'Get Request Ktub', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkRequestKtubNull = $this->checkRequestKtubNull($id);
        if($checkRequestKtubNull) return $this->responseRequestKtubNull();
        else {
            $data = $this->requestKtubService->find($id);

            return api_response(true, 200, 'Request Ktub Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required',
            'family_card_number' => 'required',
            'last_education' => 'required',
            'photo_url' => 'required',
            'visudhi_name' => 'required',
            'visudhi_place' => 'required',
            'visudhi_teacher' => 'required',
            'visudhi_role' => 'required',
            'business_name' => 'required',
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
            $data = $this->requestKtubService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Request Ktub Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkRequestKtubNull = $this->checkRequestKtubNull($id);
        if($checkRequestKtubNull) return $this->responseRequestKtubNull();
        else {
            $validator = Validator::make($request->all(), [
                'id_number' => 'required',
                'family_card_number' => 'required',
                'last_education' => 'required',
                'photo_url' => 'required',
                'visudhi_name' => 'required',
                'visudhi_place' => 'required',
                'visudhi_teacher' => 'required',
                'visudhi_role' => 'required',
                'business_name' => 'required',
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
                $data = $this->requestKtubService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Request Ktub Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkRequestKtubNull = $this->checkRequestKtubNull($id);
        if($checkRequestKtubNull) return $this->responseRequestKtubNull();
        else {
            $data = $this->requestKtubService->delete($id);

            return api_response(true, 200, 'Request Ktub Deleted', $data);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
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

    private function checkDistrictNull(int $id)
    {
        $data = $this->districtService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseDistrictNull()
    {
        return [
            'message' => 'District not Found',
            'code' => 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->districtService->get($request);

        return api_response(true, 200, 'Get District', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkDistrictNull = $this->checkDistrictNull($id);
        if($checkDistrictNull) return $this->responseDistrictNull();
        else {
            $data = $this->districtService->find($id);

            return api_response(true, 200, 'District Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_number_1' => 'required',
            'account_name_1' => 'required',
            'bank_name_1' => 'required'
        ]);;

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->districtService->create($request);
            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'District Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkDistrictNull = $this->checkDistrictNull($id);
        if($checkDistrictNull) return $this->responseDistrictNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'account_number_1' => 'required',
                'account_name_1' => 'required',
                'bank_name_1' => 'required'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            } else {
                $data = $this->districtService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'District Updated',
                    'data' => $data
                ];
            }

            return api_response($response['success'], $response['code'], $response['message'], $response['data']);
        }
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkDistrictNull = $this->checkDistrictNull($id);
        if($checkDistrictNull) return $this->responseDistrictNull();
        else {
            $data = $this->districtService->delete($id);

            return api_response(true, 200, 'District Deleted', $data);
        }
    }
}

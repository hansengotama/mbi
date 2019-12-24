<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
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

    private function checkRegionNull(int $id)
    {
        $data = $this->regionService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseRegionNull()
    {
        return [
            'message' => $message = 'Region not Found',
            'code' => $code = 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->regionService->get($request);

        return api_response(true, 200, 'Get Region', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkRegionNull = $this->checkRegionNull($id);
        if($checkRegionNull) return $this->responseRegionNull();
        else {
            $data = $this->regionService->find($id);

            return api_response(true, 200, 'Region Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            $data = $this->regionService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Region Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkRegionNull = $this->checkRegionNull($id);
        if($checkRegionNull) return $this->responseRegionNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
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
                $data = $this->regionService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Region Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkRegionNull = $this->checkRegionNull($id);
        if($checkRegionNull) return $this->responseRegionNull();
        else {
            $data = $this->regionService->delete($id);

            return api_response(true, 200, 'Region Deleted', $data);
        }
    }
}

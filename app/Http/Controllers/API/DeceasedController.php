<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\DeceasedServiceInterface;
use Illuminate\Http\Request;

class DeceasedController extends Controller
{

    private $deceasedService;

    function __construct(DeceasedServiceInterface $deceasedService)
    {
        $this->deceasedService = $deceasedService;
    }

    private function checkDeceasedNull(int $id)
    {
        $data = $this->deceasedService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseDeceasedNull()
    {
        return [
            'message' => 'Deceased not Found',
            'code' => 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->deceasedService->get($request);

        return api_response(true, 200, 'Get Deceased', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkDeceasedNull = $this->checkDeceasedNull($id);
        if($checkDeceasedNull) return $this->responseDeceasedNull();
        else {
            $data = $this->deceasedService->find($id);

            return api_response(true, 200, 'Deceased Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo_url' => 'required',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
            'close_age' => 'required',
            'buried_date' => 'required|date',
            'deceased_date' => 'required|date',
            'buried_at' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->deceasedService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Deceased Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkDeceasedNull = $this->checkDeceasedNull($id);
        if($checkDeceasedNull) return $this->responseDeceasedNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'photo_url' => 'required',
                'region_id' => 'required|exists:regions,id',
                'district_id' => 'required|exists:districts,id',
                'close_age' => 'required',
                'buried_date' => 'required|date',
                'deceased_date' => 'required|date',
                'buried_at' => 'required',
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            }else {
                $data = $this->deceasedService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Deceased Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkDeceasedNull = $this->checkDeceasedNull($id);
        if($checkDeceasedNull) return $this->responseDeceasedNull();
        else {
            $data = $this->deceasedService->delete($id);

            return api_response(true, 200, 'Deceased Deleted', $data);
        }
    }
}

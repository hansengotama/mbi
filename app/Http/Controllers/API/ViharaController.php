<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\ViharaServiceInterface;
use Illuminate\Http\Request;

class ViharaController extends Controller
{

    private $viharaService;

    function __construct(ViharaServiceInterface $viharaService)
    {
        $this->viharaService = $viharaService;
    }

    private function checkViharaNull(int $id)
    {
        $data = $this->viharaService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseViharaNull()
    {
        return [
            'message' => $message = 'Vihara not Found',
            'code' => $code = 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->viharaService->get($request);

        return api_response(true, 200, 'Get Vihara', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkViharaNull = $this->checkViharaNull($id);
        if($checkViharaNull) return $this->responseViharaNull();
        else {
            $data = $this->viharaService->find($id);

            return api_response(true, 200, 'Vihara Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'region_id' => 'required|exists:regions,id',
            'phone_number' => 'required',
            'address' => 'required',
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
            $data = $this->viharaService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Vihara Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkViharaNull = $this->checkViharaNull($id);
        if($checkViharaNull) return $this->responseViharaNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'region_id' => 'required|exists:regions,id',
                'phone_number' => 'required',
                'address' => 'required',
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
                $data = $this->viharaService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Vihara Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkViharaNull = $this->checkViharaNull($id);
        if($checkViharaNull) return $this->responseViharaNull();
        else {
            $data = $this->viharaService->delete($id);

            return api_response(true, 200, 'Vihara Deleted', $data);
        }
    }
}

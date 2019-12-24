<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;

class PanditaController extends Controller
{

    private $panditaService;

    function __construct(PanditaServiceInterface $panditaService)
    {
        $this->panditaService = $panditaService;
    }

    private function checkPanditaNull(int $id)
    {
        $data = $this->panditaService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responsePanditaNull()
    {
        return [
            'message' => $message = 'Pandita not Found',
            'code' => $code = 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->panditaService->get($request);

        return api_response(true, 200, 'Get Pandita', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkPanditaNull = $this->checkPanditaNull($id);
        if($checkPanditaNull) return $this->responsePanditaNull();
        else {
            $data = $this->panditaService->find($id);

            return api_response(true, 200, 'Pandita Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vihara_id' => 'required|exists:viharas,id',
            'phone_number' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->panditaService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Pandita Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkPanditaNull = $this->checkPanditaNull($id);
        if($checkPanditaNull) return $this->responsePanditaNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'vihara_id' => 'required|exists:viharas,id',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            }else {
                $data = $this->panditaService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Pandita Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkPanditaNull = $this->checkPanditaNull($id);
        if($checkPanditaNull) return $this->responsePanditaNull();
        else {
            $data = $this->panditaService->delete($id);

            return api_response(true, 200, 'Pandita Deleted', $data);
        }
    }
}

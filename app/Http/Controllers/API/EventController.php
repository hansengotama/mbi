<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{

    private $eventService;

    function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    private function checkEventNull(int $id)
    {
        $data = $this->eventService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseEventNull()
    {
        return [
            'message' => $message = 'Event not Found',
            'code' => $code = 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->eventService->get($request);

        return api_response(true, 200, 'Get Event', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkEventNull = $this->checkEventNull($id);
        if($checkEventNull) return $this->responseEventNull();
        else {
            $data = $this->eventService->find($id);

            return api_response(true, 200, 'Event Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vihara_id' => 'required|exists:viharas,id',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
            'description' => 'required',
            'address' => 'required',
            'poster_url' => 'required',
        ]);;

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->eventService->create($request);
            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Event Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkEventNull = $this->checkEventNull($id);
        if($checkEventNull) return $this->responseEventNull();
        else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'vihara_id' => 'required|exists:viharas,id',
                'region_id' => 'required|exists:regions,id',
                'district_id' => 'required|exists:districts,id',
                'description' => 'required',
                'address' => 'required',
                'poster_url' => 'required',
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            } else {
                $data = $this->eventService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Event Updated',
                    'data' => $data
                ];
            }

            return api_response($response['success'], $response['code'], $response['message'], $response['data']);
        }
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkEventNull = $this->checkEventNull($id);
        if($checkEventNull) return $this->responseEventNull();
        else {
            $data = $this->eventService->delete($id);

            return api_response(true, 200, 'Event Deleted', $data);
        }
    }
}

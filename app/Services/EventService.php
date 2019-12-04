<?php

namespace App\Services;

use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Services\Interfaces\EventServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventService implements EventServiceInterface
{

    private $eventRepository;

    function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['vihara_id'] = $request['vihara_id'];
        $formData['description'] = $request['description'];
        $formData['address'] = $request['address'];
        $formData['poster_url'] = $request['poster_url'];

        return $formData;
    }

    public function get()
    {
        $data = $this->eventRepository->get();

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Event',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->eventRepository->find($id);
        $message = 'Event Found';
        $code = 200;

        if ($data == null) {
            $message = 'Event not Found';
            $code = 404;
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }

    public function create(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vihara_id' => 'required',
            'description' => 'required',
            'address' => 'required',
            'poster_url' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ];
        }else {
            $formData = $this->modelMapping($request->all());
            $data = $this->eventRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Event Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $event = $this->eventRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vihara_id' => 'required',
            'description' => 'required',
            'address' => 'required',
            'poster_url' => 'required',
        ]);

        if($event != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->eventRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Event Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Event not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $event = $this->eventRepository->find($id);
        $data = null;
        $message = 'Event Deleted';
        $code = 200;

        if($event == null) {
            $message = 'Event not Found';
            $code = 404;
        }else {
            $data = $this->eventRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\PanditaRepositoryInterface;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanditaService implements PanditaServiceInterface
{

    private $panditaRepository;

    function __construct(PanditaRepositoryInterface $panditaRepository)
    {
        $this->panditaRepository = $panditaRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['vihara_id'] = $request['vihara_id'];
        $formData['phone_number'] = $request['phone_number'];

        return $formData;
    }

    public function get()
    {
        $data = $this->panditaRepository->get();

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Pandita',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->panditaRepository->find($id);
        $message = 'Pandita Found';
        $code = 200;

        if ($data == null) {
            $message = 'Pandita not Found';
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
            'phone_number' => 'required'
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
            $data = $this->panditaRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Pandita Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $pandita = $this->panditaRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vihara_id' => 'required',
            'phone_number' => 'required'
        ]);

        if($pandita != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->panditaRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Pandita Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Pandita not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $pandita = $this->panditaRepository->find($id);
        $data = null;
        $message = 'Pandita Deleted';
        $code = 200;

        if($pandita == null) {
            $message = 'Pandita not Found';
            $code = 404;
        }else {
            $data = $this->panditaRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\ViharaRepositoryInterface;
use App\Services\Interfaces\ViharaServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViharaService implements ViharaServiceInterface {

    private $viharaRepository;

    function __construct(ViharaRepositoryInterface $viharaRepository)
    {
        $this->viharaRepository = $viharaRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['region_id'] = $request['region_id'];
        $formData['phone_number'] = $request['phone_number'];
        $formData['address'] = $request['address'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->viharaRepository->get($text, $page, $per_page);

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Vihara',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->viharaRepository->find($id);
        $message = 'Vihara Found';
        $code = 200;

        if ($data == null) {
            $message = 'Vihara not Found';
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
            'region_id' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
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
            $data = $this->viharaRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Vihara Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $vihara = $this->viharaRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'region_id' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        if($vihara != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->viharaRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Vihara Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Vihara not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete($id)
    {
        $vihara = $this->viharaRepository->find($id);
        $data = null;
        $message = 'Vihara Deleted';
        $code = 200;

        if($vihara == null) {
            $message = 'Vihara not Found';
            $code = 404;
        }else {
            $data = $this->viharaRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

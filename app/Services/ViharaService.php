<?php

namespace App\Services;

use App\Repositories\Interfaces\ViharaRepositoryInterface;
use App\Services\Interfaces\ViharaServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViharaService implements ViharaServiceInterface {

    private $viharaRepository;

    function __construct(ViharaRepositoryInterface $viharaRepository)
    {
        $this->viharaRepository = $viharaRepository;
    }

    public function get()
    {
        $data = $this->viharaRepository->get();

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
            $data = $this->viharaRepository->create($request->all());

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
                $data = $this->viharaRepository->update($id, $request->all());

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

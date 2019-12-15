<?php

namespace App\Services;

use App\Repositories\Interfaces\RegionRepositoryInterface;
use App\Services\Interfaces\RegionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionService implements RegionServiceInterface
{

    private $regionRepository;

    function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->regionRepository->get($text, $page, $per_page);

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Region',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->regionRepository->find($id);
        $message = 'Region Found';
        $code = 200;

        if ($data == null) {
            $message = 'Region not Found';
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
            'name' => 'required'
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
            $data = $this->regionRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Region Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $region = $this->regionRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($region != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->regionRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Region Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Region not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $region = $this->regionRepository->find($id);
        $data = null;
        $message = 'Region Deleted';
        $code = 200;

        if($region == null) {
            $message = 'Region not Found';
            $code = 404;
        }else {
            $data = $this->regionRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

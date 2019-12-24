<?php

namespace App\Services;

use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Services\Interfaces\DistrictServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictService implements DistrictServiceInterface
{

    private $districtRepository;

    function __construct(DistrictRepositoryInterface $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['account_number_1'] = $request['account_number_1'];
        $formData['account_number_2'] = isset($request['account_number_2']) ? $request['account_number_2'] : null;
        $formData['account_name_1'] = $request['account_name_1'];
        $formData['account_name_2'] = isset($request['account_name_2']) ? $request['account_name_2'] : null;

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->districtRepository->get($text, $page, $per_page);

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get District',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->districtRepository->find($id);
        $message = 'District Found';
        $code = 200;

        if ($data == null) {
            $message = 'District not Found';
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
            'account_number_1' => 'required',
            'account_name_1' => 'required'
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
            $data = $this->districtRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'District Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $district = $this->districtRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_number_1' => 'required',
            'account_name_1' => 'required'
        ]);

        if($district != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->districtRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'District Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'District not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $district = $this->districtRepository->find($id);
        $data = null;
        $message = 'District Deleted';
        $code = 200;

        if($district == null) {
            $message = 'District not Found';
            $code = 404;
        }else {
            $data = $this->districtRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

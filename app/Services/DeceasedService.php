<?php

namespace App\Services;

use App\Repositories\Interfaces\DeceasedRepositoryInterface;
use App\Services\Interfaces\DeceasedServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeceasedService implements DeceasedServiceInterface
{

    private $deceasedRepository;

    function __construct(DeceasedRepositoryInterface $deceasedRepository)
    {
        $this->deceasedRepository = $deceasedRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['photo_url'] = $request['photo_url'];
        $formData['region_id'] = $request['region_id'];
        $formData['close_age'] = $request['close_age'];
        $formData['buried_date'] = Carbon::parse($request['buried_date'])->format('Y-m-d H:i:s');
        $formData['deceased_date'] = Carbon::parse($request['deceased_date'])->format('Y-m-d H:i:s');
        $formData['buried_at'] = $request['buried_at'];
        $formData['type'] = $request['type'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->deceasedRepository->get($text, $page, $per_page);

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Deceased',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->deceasedRepository->find($id);
        $message = 'Deceased Found';
        $code = 200;

        if ($data == null) {
            $message = 'Deceased not Found';
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
            'photo_url' => 'required',
            'region_id' => 'required',
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
                'data' => $validator->errors()
            ];
        }else {
            $formData = $this->modelMapping($request->all());
            $data = $this->deceasedRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Deceased Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $deceased = $this->deceasedRepository->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo_url' => 'required',
            'region_id' => 'required',
            'close_age' => 'required',
            'buried_date' => 'required|date',
            'deceased_date' => 'required|date',
            'buried_at' => 'required',
            'type' => 'required',
        ]);

        if($deceased != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->deceasedRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Deceased Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Deceased not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $deceased = $this->deceasedRepository->find($id);
        $data = null;
        $message = 'Deceased Deleted';
        $code = 200;

        if($deceased == null) {
            $message = 'Deceased not Found';
            $code = 404;
        }else {
            $data = $this->deceasedRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

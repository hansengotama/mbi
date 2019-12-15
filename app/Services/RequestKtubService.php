<?php

namespace App\Services;

use App\Repositories\Interfaces\RequestKtubRepositoryInterface;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestKtubService implements RequestKtubServiceInterface {

    private $requestKtubRepository;

    function __construct(RequestKtubRepositoryInterface $requestKtubRepository)
    {
        $this->requestKtubRepository = $requestKtubRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['user_id'] = Auth::id();
        $formData['id_number'] = $request['id_number'];
        $formData['family_card_number'] = $request['family_card_number'];
        $formData['last_education'] = $request['last_education'];
        $formData['photo_url'] = $request['photo_url'];
        $formData['visudhi_name'] = $request['visudhi_name'];
        $formData['visudhi_place'] = $request['visudhi_place'];
        $formData['visudhi_teacher'] = $request['visudhi_teacher'];
        $formData['visudhi_role'] = $request['visudhi_role'];
        $formData['business_name'] = $request['business_name'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->requestKtubRepository->get($text, $page, $per_page);

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Request Ktub',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->requestKtubRepository->find($id);
        $message = 'Request Ktub Found';
        $code = 200;

        if ($data == null) {
            $message = 'Request Ktub not Found';
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
            'id_number' => 'required',
            'family_card_number' => 'required',
            'last_education' => 'required',
            'photo_url' => 'required',
            'visudhi_name' => 'required',
            'visudhi_place' => 'required',
            'visudhi_teacher' => 'required',
            'visudhi_role' => 'required',
            'business_name' => 'required'
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
            $data = $this->requestKtubRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Request Ktub Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $requestKtub = $this->requestKtubRepository->find($id);
        $validator = Validator::make($request->all(), [
            'id_number' => 'required',
            'family_card_number' => 'required',
            'last_education' => 'required',
            'photo_url' => 'required',
            'visudhi_name' => 'required',
            'visudhi_place' => 'required',
            'visudhi_teacher' => 'required',
            'visudhi_role' => 'required',
            'business_name' => 'required'
        ]);

        if($requestKtub != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->requestKtubRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Request Ktub Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Request Ktub not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $requestKtub = $this->requestKtubRepository->find($id);
        $data = null;
        $message = 'Request Ktub Deleted';
        $code = 200;

        if($requestKtub == null) {
            $message = 'Request Ktub not Found';
            $code = 404;
        }else {
            $data = $this->requestKtubRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Services\Interfaces\DonationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationService implements DonationServiceInterface {

    private $donationRepository;

    function __construct(DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['donors_name'] = $request['donors_name'];
        $formData['amount'] = $request['amount'];

        return $formData;
    }

    public function get()
    {
        $data = $this->donationRepository->get();

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Donation',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->donationRepository->find($id);
        $message = 'Donation Found';
        $code = 200;

        if ($data == null) {
            $message = 'Donation not Found';
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
            'donors_name' => 'required',
            'amount' => 'required'
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
            $data = $this->donationRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Donation Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $donation = $this->donationRepository->find($id);
        $validator = Validator::make($request->all(), [
            'donors_name' => 'required',
            'amount' => 'required'
        ]);

        if($donation != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->donationRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Donation Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Donation not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $donation = $this->donationRepository->find($id);
        $data = null;
        $message = 'Donation Deleted';
        $code = 200;

        if($donation == null) {
            $message = 'Donation not Found';
            $code = 404;
        }else {
            $data = $this->donationRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

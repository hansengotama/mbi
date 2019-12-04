<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyVacancyRepositoryInterface;
use App\Services\Interfaces\CompanyVacancyServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyVacancyService implements CompanyVacancyServiceInterface
{

    private $companyVacancyRepository;

    function __construct(CompanyVacancyRepositoryInterface $companyVacancyRepository)
    {
        $this->companyVacancyRepository = $companyVacancyRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['region_id'] = $request['region_id'];
        $formData['name'] = $request['name'];
        $formData['logo_url'] = $request['logo_url'];
        $formData['city'] = $request['city'];
        $formData['position'] = $request['position'];
        $formData['field'] = $request['field'];
        $formData['detail'] = $request['detail'];
        $formData['from'] = Carbon::parse($request['from'])->format('Y-m-d H:i:s');
        $formData['until'] = Carbon::parse($request['until'])->format('Y-m-d H:i:s');
        $formData['pic_name'] = $request['pic_name'];
        $formData['pic_email'] = $request['pic_email'];
        $formData['pic_phone_number'] = $request['pic_phone_number'];

        return $formData;
    }

    public function get()
    {
        $data = $this->companyVacancyRepository->get();

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get Company Vacancy',
            'data' => $data
        ];
    }

    public function find(int $id)
    {
        $data = $this->companyVacancyRepository->find($id);
        $message = 'Company Vacancy Found';
        $code = 200;

        if ($data == null) {
            $message = 'Company Vacancy not Found';
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
            'region_id' => 'required',
            'name' => 'required',
            'logo_url' => 'required',
            'city' => 'required',
            'position' => 'required',
            'field' => 'required',
            'detail' => 'required',
            'from' => 'required|date',
            'until' => 'required|date',
            'pic_name' => 'required',
            'pic_email' => 'required|email',
            'pic_phone_number' => 'required',
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
            $data = $this->companyVacancyRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Company Vacancy Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $companyVacancy = $this->companyVacancyRepository->find($id);
        $validator = Validator::make($request->all(), [
            'region_id' => 'required',
            'name' => 'required',
            'logo_url' => 'required',
            'city' => 'required',
            'position' => 'required',
            'field' => 'required',
            'detail' => 'required',
            'from' => 'required|date',
            'until' => 'required|date',
            'pic_name' => 'required',
            'pic_email' => 'required|email',
            'pic_phone_number' => 'required',
        ]);

        if($companyVacancy != null) {
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            }else {
                $formData = $this->modelMapping($request->all());
                $data = $this->companyVacancyRepository->update($id, $formData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Company Vacancy Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => true,
                'code' => 404,
                'message' => 'Company Vacancy not found',
                'data' => null
            ];
        }

        return $response;
    }

    public function delete(int $id)
    {
        $companyVacancy = $this->companyVacancyRepository->find($id);
        $data = null;
        $message = 'Company Vacancy Deleted';
        $code = 200;

        if($companyVacancy == null) {
            $message = 'Company Vacancy not Found';
            $code = 404;
        }else {
            $data = $this->companyVacancyRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}

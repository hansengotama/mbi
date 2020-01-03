<?php

namespace App\Http\Controllers\API;

use App\Services\Interfaces\CompanyVacancyServiceInterface;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyVacancyController extends Controller
{

    private $companyVacancyService;

    function __construct(CompanyVacancyServiceInterface $companyVacancyService)
    {
        $this->companyVacancyService = $companyVacancyService;
    }

    private function checkCompanyVacancyNull(int $id)
    {
        $data = $this->companyVacancyService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseCompanyVacancyNull()
    {
        return [
            'message' => 'Company Vacancy not Found',
            'code' => 404,
            'data' => null,
            'success' => false
        ];
    }

    public function get(Request $request)
    {
        $data = $this->companyVacancyService->get($request);

        return api_response(true, 200, 'Get Company Vacancy', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkCompanyVacancyNull = $this->checkCompanyVacancyNull($id);
        if($checkCompanyVacancyNull) return $this->responseCompanyVacancyNull();
        else {
            $data = $this->companyVacancyService->find($id);

            return api_response(true, 200, 'Company Vacancy Found', $data);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'district_id' => 'required|exists:districts,id'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            $data = $this->companyVacancyService->create($request);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'Company Vacancy Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkCompanyVacancyNull = $this->checkCompanyVacancyNull($id);
        if($checkCompanyVacancyNull) return $this->responseCompanyVacancyNull();
        else {
            $validator = Validator::make($request->all(), [
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
                'district_id' => 'required|exists:districts,id'
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            }else {
                $data = $this->companyVacancyService->update($id, $request);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Company Vacancy Updated',
                    'data' => $data
                ];
            }
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkCompanyVacancyNull = $this->checkCompanyVacancyNull($id);
        if($checkCompanyVacancyNull) return $this->responseCompanyVacancyNull();
        else {
            $data = $this->companyVacancyService->delete($id);

            return api_response(true, 200, 'Company Vacancy Deleted', $data);
        }
    }
}

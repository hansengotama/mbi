<?php

namespace App\Http\Controllers\API;

use App\Services\Interfaces\CompanyVacancyServiceInterface;
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

    public function get(Request $request)
    {
        $data = $this->companyVacancyService->get($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->companyVacancyService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function create(Request $request)
    {
        $data = $this->companyVacancyService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->companyVacancyService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->companyVacancyService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\PanditaRepositoryInterface;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanditaService implements PanditaServiceInterface
{

    private $panditaRepository;

    function __construct(PanditaRepositoryInterface $panditaRepository)
    {
        $this->panditaRepository = $panditaRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['vihara_id'] = $request['vihara_id'];
        $formData['phone_number'] = $request['phone_number'];

        return $formData;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->panditaRepository->get($text, $page, $per_page);
    }

    public function find(int $id)
    {
        return $this->panditaRepository->find($id);
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->panditaRepository->create($formData);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->panditaRepository->update($id, $formData);
    }

    public function delete(int $id)
    {
        return $this->panditaRepository->delete($id);
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class UserService implements UserServiceInterface
{

    private $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['email'] = $request['email'];
        $formData['role'] = (isset($request['role'])) ? $request['role'] : "user";
        $formData['birth_of_date'] = Carbon::parse($request['birth_of_date'])->format('Y-m-d H:i:s');
        $formData['phone_number'] = $request['phone_number'];
        $formData['password'] = $request['password'];
        $formData['district_id'] = $request['district_id'];

        return $formData;
    }

    public function create(Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->userRepository->create($formData);
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        return $this->userRepository->get($text, $page, $per_page);
    }

    public function update(int $id, Request $request)
    {
        $formData = $this->modelMapping($request->all());

        return $this->userRepository->update($id, $formData);
    }

    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }
}

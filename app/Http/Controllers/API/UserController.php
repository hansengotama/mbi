<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        $this->apiHelper = new ApiHelper();
    }

    public function login(Request $request)
    {
        $this->userService->login($request);
    }

    public function create(Request $request)
    {
        $data = $this->userService->create($request);

        return $this->apiHelper->response(
            $data['success'],
            $data['code'],
            $data['message'],
            $data['data']
        );
    }

    public function get()
    {
        $data = $this->userService->get();

        return $this->apiHelper->response(
            $data['success'],
            $data['code'],
            $data['message'],
            $data['data']
        );
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->userService->find($id);

        return $this->apiHelper->response(
            $data['success'],
            $data['code'],
            $data['message'],
            $data['data']
        );
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->userService->update($id, $request);

        return $this->apiHelper->response(
            $data['success'],
            $data['code'],
            $data['message'],
            $data['data']
        );
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->userService->delete($id);

        return $this->apiHelper->response(
            $data['success'],
            $data['code'],
            $data['message'],
            $data['data']
        );
    }
}

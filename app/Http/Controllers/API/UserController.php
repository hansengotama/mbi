<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\api_response;

class UserController extends Controller
{

    private $userService;

    function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $data = $this->userService->login($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function logout()
    {
        if (Auth::check())
            Auth::user()->OauthAccessToken()->delete();

        return api_response(true, 200, 'User Logout', null);
    }

    public function create(Request $request)
    {
        $data = $this->userService->create($request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function get()
    {
        $data = $this->userService->get();

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function find($id)
    {
        $id = intval($id);
        $data = $this->userService->find($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function update($id, Request $request)
    {
        $id = intval($id);
        $data = $this->userService->update($id, $request);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }

    public function delete($id)
    {
        $id = intval($id);
        $data = $this->userService->delete($id);

        return api_response($data['success'], $data['code'], $data['message'], $data['data']);
    }
}

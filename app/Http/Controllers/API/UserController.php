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
        $this->userService->create($request);
    }
}

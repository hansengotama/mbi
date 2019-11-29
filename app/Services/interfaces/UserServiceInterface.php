<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface UserServiceInterface
{

    public function login(Request $request);
    public function create(Request $request);
}

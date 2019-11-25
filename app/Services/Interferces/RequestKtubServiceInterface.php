<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface RequestKtubServiceInterface
{

    public function create(Request $request);
}

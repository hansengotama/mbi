<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface EventServiceInterface
{

    public function create(Request $request);
}

<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface DeceasedServiceInterface
{

    public function create(Request $request);
}

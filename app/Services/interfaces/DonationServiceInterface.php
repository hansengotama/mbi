<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface DonationServiceInterface
{

    public function create(Request $request);
}

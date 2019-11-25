<?php

namespace App\Services;

use App\Repositories\Interfaces\DeceasedRepositoryInterface;
use App\Services\Interfaces\DeceasedServiceInterface;
use Illuminate\Http\Request;

class DeceasedService implements DeceasedServiceInterface {

    private $deceasedRepository;

    function __construct(DeceasedRepositoryInterface $deceasedRepository)
    {
        $this->deceasedRepository = $deceasedRepository;
    }

    public function create(Request $request)
    {

    }
}

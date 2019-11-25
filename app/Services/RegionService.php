<?php

namespace App\Services;

use App\Repositories\Interfaces\RegionRepositoryInterface;
use App\Services\Interfaces\RegionServiceInterface;
use Illuminate\Http\Request;

class RegionService implements RegionServiceInterface {

    private $regionRepository;

    function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function create(Request $request)
    {

    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\PanditaRepositoryInterface;
use App\Services\Interfaces\PanditaServiceInterface;
use Illuminate\Http\Request;

class PanditaService implements PanditaServiceInterface {

    private $panditaRepository;

    function __construct(PanditaRepositoryInterface $panditaRepository)
    {
        $this->panditaRepository = $panditaRepository;
    }

    public function create(Request $request)
    {

    }
}

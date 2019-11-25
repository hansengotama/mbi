<?php

namespace App\Services;

use App\Repositories\Interfaces\ViharaRepositoryInterface;
use App\Services\Interfaces\ViharaServiceInterface;
use Illuminate\Http\Request;

class ViharaService implements ViharaServiceInterface {

    private $viharaRepository;

    function __construct(ViharaRepositoryInterface $viharaRepository)
    {
        $this->viharaRepository = $viharaRepository;
    }

    public function create(Request $request)
    {

    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\RequestKtubRepositoryInterface;
use App\Services\Interfaces\RequestKtubServiceInterface;
use Illuminate\Http\Request;

class RequestKtubService implements RequestKtubServiceInterface {

    private $requestKtubRepository;

    function __construct(RequestKtubRepositoryInterface $requestKtubRepository)
    {
        $this->requestKtubRepository = $requestKtubRepository;
    }

    public function create(Request $request)
    {

    }
}

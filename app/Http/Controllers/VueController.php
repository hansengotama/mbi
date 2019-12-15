<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CompanyVacancyServiceInterface;
use function App\Helpers\api_response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VueController extends Controller
{

    public function index()
    {
        return view('index');
    }
}

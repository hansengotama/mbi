<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface DeceasedServiceInterface
{

    public function get();
    public function find(int $id);
    public function create(Request $request);
    public function update(int $id, Request $request);
    public function delete(int $id);
}

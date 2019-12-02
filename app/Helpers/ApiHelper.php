<?php

namespace App\Helpers;

class ApiHelper{

    public function response(bool $success ,int $code ,string $message ,$response = [])
    {
        return response()->json([
            'success' => $success,
            'code'    => $code,
            'message' => $message,
            'result'  => $response
        ], 200);
    }
}

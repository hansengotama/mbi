<?php

namespace App\Helpers;

class ApiHelper{

    public function response(bool $success,int $code,$response = [],string $message)
    {
        return response()->json([
            'success'=>$success,
            'code'   =>$code,
            'result' =>$response,
            'message'=>$message
        ], 200);
    }
}

<?php

namespace App\Traits;

trait HttpResponseTrait
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => "Request successful",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, $message = null, $code=400){
        return response()->json([
            'status' => "Request failed",
            'message' => $message,
            'data' => $data
        ], $code);
    }
}

<?php


namespace App\Traits;


trait ApiResponse
{
    protected function success($data = null, string $msg = null){
        return response()->json([
            'success' => true,
            'error_code' => 0,
            'message' => $msg,
            'data' => $data
        ]);
    }

    protected function error(int $errorCode, $data = null, string $msg = null, int $httpCode = 200){
        return response()->json([
            'success' => false,
            'error_code' => $errorCode,
            'message' => $msg,
            'data' => $data
        ], $httpCode);
    }
}

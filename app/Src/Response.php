<?php

namespace App\Src;

class Response
{
    public static function data($message = 'message', $code = 200, $payload = [])
    {
        return response([
            'status' => $code <= 200,
            'code' => $code,
            'message' => $message,
            'payload' => $payload,
        ], $code);
    }

    public static function error($message = 'error message', $code = 400, $payload = [])
    {
        return response([
            'status' => false,
            'code' => $code,
            'message' => $message,
            'payload' => $payload,
        ], $code);
    }

    public static function success($message = 'success', $code = 200, $payload = [])
    {
        return response([
            'status' => true,
            'code' => $code,
            'message' => $message,
            'payload' => $payload,
        ], $code);
    }
}

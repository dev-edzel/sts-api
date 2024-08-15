<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HandlesHttpResponses
{
    protected function success(string $message, mixed $data = null, int $statusCode = null): JsonResponse
    {
        return response()->json([
            'status' => 0,
            'message' => $message,
            'data' => $data ?? []
        ], $statusCode ?? 200);
    }

    protected function error(string $message, mixed $data = null, int $statusCode = null): JsonResponse
    {
        return response()->json([
            'status' => 1,
            'message' => $message,
            'data' => $data ?? []
        ], $statusCode ?? 400);
    }
}

<?php

namespace App\Exceptions;

use Exception;

class NotAuthException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Anda tidak terautentikasi',
        ], 401);
    }
}
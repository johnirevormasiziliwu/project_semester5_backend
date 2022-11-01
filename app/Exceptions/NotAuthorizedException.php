<?php

namespace App\Exceptions;

use Exception;

class NotAuthorizedException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Anda tidak memiliki hak ases ke halaman ini',
        ], 403);
    }
}
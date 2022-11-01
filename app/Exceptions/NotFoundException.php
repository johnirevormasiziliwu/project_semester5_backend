<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Data yang anda mita tidak ditemukan',
        ], 404);
    }
}
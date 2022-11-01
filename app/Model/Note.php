<?php

namespace App\Model;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Note
{
    public static function getAllByUserId($userId)
    {
       return DB::table('notes')
        ->where('n_us_id', $userId)->get();
    }

    public static function insert(array $note)
    {
        return DB::table('notes')->insertGetId($note);
       
    }

   
    public static function getByIdAndUserId($noteId, $userId)
    {
        return DB::table('notes')
        ->where('n_us_id', $userId)
        ->where('n_id', $noteId)
        ->first();
    }
}
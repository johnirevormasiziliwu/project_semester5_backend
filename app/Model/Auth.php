<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class Auth {
   
   public static function verify($username, $password)
   {
      return DB::table('users')
      ->where('us_email', $username)
      ->first();
      
   }

   public static function createToken($userId)
   {
   
      $token = md5(date('Y:m:d H:i:s').$userId);
      $expired = date('Y-m-d H:i:s', strtotime( now() . ' +1 day'));
      $tokens = [
         'tk_token' => $token,
         'tk_expired' => $expired,
         'tk_us_id' => $userId
      ];
      $result = DB::table('tokens')->insert($tokens);
      if($result) {
         return $token;
      }
      return $result;
   }
}
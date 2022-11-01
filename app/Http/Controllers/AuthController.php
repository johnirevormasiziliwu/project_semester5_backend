<?php 
namespace App\Http\Controllers;

use App\Model\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
   public function verify()
   {
      $username = $_SERVER['PHP_AUTH_USER'];
      $password = $_SERVER['PHP_AUTH_PW'];
      $user = Auth::verify($username, $password);
      if($user != null){
         if(password_verify($password,$user->us_password)){
            $token = Auth::createToken($user->us_id);
            if($token != null) {
               
               return response()->json([
                  'email' => $user->us_email,
                  'name' => $user->us_name,
                  'token' => $token
               ]);
            }
         }
      }
      return response()->json([],401);
   }

   public function cobaDBTransaksi()
   {
      DB::beginTransaction();
      try {
        $usId = DB::table('users')->insertGetId([
            'us_name' => 'Bobby simanjutang',
            'us_email'=> 'Bobby@gmail.com',
            'us_password' => password_hash('admin', PASSWORD_DEFAULT) 
        ]);
        $expired = date('Y-m-d H:i:s', strtotime(now(). '+ 1 day'));
        
        $token = \Illuminate\Support\Str::uuid();
        DB::table('tokens')->insert([
         'tk_token' => $token,
         'tk_expired' => $expired,
         'tk_us_id' => $usId
        ]);
        
        
         DB::commit();
         return response()->json(['message' => "User Berhasil Di simpan",
         'user' => [
            'name' => 'Bobby simanjutang',
            'email' => 'Bobby@gmail.com',
            'token' => $token
         ]

      ]);
      
      }catch (\Exception $e) {
         
         DB::rollBack();
         return \response()->json(['message' => "User Gagal Disimpan"]);
      }
   }
   
}
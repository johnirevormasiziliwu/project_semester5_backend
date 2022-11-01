<?php

namespace App\Http\Controllers;

use App\Exceptions\NotAuthException;
use App\Exceptions\NotAuthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class PbeBaseController extends Controller
{
    private  $User;
    
    public function __construct()
    {
       
        $token = request()->header('pbe-token');
        $token =  DB::table('tokens')
        ->where('tk_token',$token)
        ->where('tk_expired', '>', now())->first();
        if($token === null) {
            throw new NotAuthException();
            exit;
        }
        
        $this->User = DB::table('users')
        ->where('us_id', $token->tk_us_id)->first();
    }

    public function getUserId()
    {
        return $this->User->us_id;
    }
    
    public function getUserRole()
    {
        return $this->User->us_role;
    }

    public function isAdmin()
    {
        if($this->getUserRole() == "user") {
            throw new NotAuthorizedException();
            exit;
        }
    }
    public function isSuperadmin()
    {
        if ($this->getUserRole() == "user" || $this->getUserRole() == "admin") {
            throw new NotAuthorizedException();
            exit;
        }
    }
}
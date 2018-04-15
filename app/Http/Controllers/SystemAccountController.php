<?php

namespace App\Http\Controllers;

use App\Model\SystemAccount;
use App\Model\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class SystemAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //
    public function login(Request $request){
        try{
            $login_name = $request['username'];
            $password = $request['password'];
            $systemAccout = SystemAccount::where('login_name',$login_name)->first();
            if(is_null($systemAccout)){
                throw new Exception('登录失败');
            }
            $systemAccout = $systemAccout->toArray();
            if($systemAccout['password'] === $password){
                return response()->json(['error'=>"",'code'=>200,'user'=>$systemAccout]);
            }else{
                throw new Exception('登录失败');
            }
        }catch (Exception $e){
            return response()->make(['error'=>$e->getMessage(),'code'=>'401','user'=>[]],200);
        }

    }

}

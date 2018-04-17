<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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
    public function createUser(Request $request)
    {
        $user = User::create($request->input('params'));
        return response()->json($user);
    }

    public function updateUser(Request $request)
    {
        $params = $request->input('params');
        $id = array_get($params,'id');
        $user = User::find($id);
        $user->names = array_get($params,'names');
        $user->sex = array_get($params,'sex');
        $user->birthday = array_get($params,'birthday');
        $user->address = array_get($params,'address');

        $user->save();

        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        list($code,$msg,$res) = $this->_doDelete($id);
        return response()->json($msg);
    }
    public function batchDeleteUser(Request $request)
    {
        $ids = $request->input('ids');
        list($code,$msg,$res) = $this->_doDelete($ids);
        return response()->json($msg);
    }

    public function index(Request $request)
    {
        if(!empty($request->input('name'))){
            $name = $request->input('name');
            $user = User::where('names',$name)->paginate(15);
        }else{
            $user = User::paginate(15);
        }

        return response()->json($user);
    }
    private function _doDelete($ids){
        $id_arr = explode(',',$ids);
        $res = User::whereIn('id',$id_arr)->delete();
        if($res){;
            $returnData = [0,'删除成功',[]];
        }else{
            $returnData = [-1,'删除失败',[]];
        }
        return $returnData;
    }
}

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
        $user = User::create($request->all());
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

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('删除成功');
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
}

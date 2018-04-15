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

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->make = $request->input('make');
        $user->model = $request->input('model');
        $user->year = $request->input('year');
        $user->save();

        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('删除成功');
    }

    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
}

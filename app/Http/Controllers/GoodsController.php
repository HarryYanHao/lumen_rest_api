<?php

namespace App\Http\Controllers;

use App\Model\Artical;
use App\Model\Goods;
use App\Model\User;
use Illuminate\Http\Request;

class GoodsController extends Controller
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
    public function index(Request $request)
    {
        if(!empty($request->input('goods_name'))){
            $goods_name = $request->input('goods_name');
            $goods = Goods::where('names','like','%'.$goods_name.'%')->paginate(15);
        }else{
            $goods = Goods::paginate(15);
        }

        return response()->json($goods);
    }

}

<?php

namespace App\Http\Controllers;

use App\Model\Artical;
use App\Model\User;
use Illuminate\Http\Request;

class ArticalController extends Controller
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
    public function listArtical(Request $request){
        if(!empty($request->input('title'))){
            $title = $request->input('title');
            $artical = Artical::where('names','like','%'.$title.'%')->get();
        }else{
            $artical = Artical::get();
        }
        return response()->json(['articals'=>$artical]);
    }

}

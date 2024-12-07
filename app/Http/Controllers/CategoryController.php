<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CategoryController extends Controller
{
    function CategoryList(Request $request){
        $user_id=$request->header('id');
        $data = Category::where('user_id',$user_id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    function CategoryCreate(Request $request){
        $user_id=$request->header('id');
        return Category::create([
            'name'=>$request->input('name'),
            'type'=>$request->input('type'),
            'user_id'=>$user_id
        ]);
    }

//    function CategoryDelete(Request $request){
//        $category_id=$request->input('id');
//        $user_id=$request->header('id');
//        return Category::where('id',$category_id)->where('user_id',$user_id)->delete();
//    }



    function CategoryUpdate(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
        ]);
    }
}

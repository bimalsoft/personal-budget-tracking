<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    function CategoryList(Request $request)
    {
        $user_id=$request->header('id');
        return Category::where('user_id',$user_id)->get();
    }
    function CategoryCreate(Request $request)
    {
        $user_id=$request->header('id');
        return Category::create([
            'name' => $request->input('name'),
            'user_id'=>$user_id,
        ]);
    }


}

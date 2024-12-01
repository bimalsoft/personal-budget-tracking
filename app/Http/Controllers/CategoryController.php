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
    function addCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'type' => 'required|string',
            ]);
            $email = JWTToken::VerifyToken($request->cookie("token"));
            $user = User::where('email', $email)->first();
            $request["user_id"] = $user->id;

            Category::create($request->all());
            return response()->json(['status' => 'success', 'message' => 'Category added successfully!']);

        }catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }
    function getCategory(Request $request){
        $email = JWTToken::VerifyToken($request->cookie("token"));
        $user = User::where('email', $email)->first();

        $categories = Category::where('user_id', $user->id)->get();
        return response()->json(['status' => 'success', 'categories' => $categories]);
    }
}

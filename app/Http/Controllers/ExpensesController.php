<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Category;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Routing\Controller;

class ExpensesController extends Controller
{
    function ExpensesList(Request $request)
    {

    }

    function CategoryCreate(Request $request)
    {
        $token=$request->cookie('token');
        $email = JWTToken::VerifyToken($token);
        $user =User::where('email',$email)->first();

            return Expenses::create([
                'name'=>$request->input('name'),
                'user_id'=>$user->id,
                'amount'=>$request->input('amount'),
                'description'=>$request->input('description'),
                'date'=>$request->input('date'),
                'receipt'=>$request->input('receipt')
            ]);
    }
}

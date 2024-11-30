<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class IncomeController extends Controller
{
    function addIncome(Request $request){
        try {
            $request->validate([
                'amount' => 'required',
                'date' => 'required',
                'category_id' => 'required',
            ]);
            $email = JWTToken::VerifyToken($request->cookie("token"));
            $user = User::where('email', $email)->first();
            $request["user_id"] = $user->id;
            Income::create($request->all());
            $user->increment('balance', $request->input('amount'));
            return response()->json(['status' => 'success', ',message' => 'Income added successfully!']);

        }catch (Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }




    //End
}

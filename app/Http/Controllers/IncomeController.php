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
            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $request["user_id"] = $user->id;
            Income::create($request->all());
            $user->increment('balance', $request->input('amount'));
            return response()->json(['status' => 'success', ',message' => 'Income added successfully!']);

        }catch (Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function getIncome(Request $request)
    {

        try {
            $email = $request->header('email');
            $user = User::where('email', $email)->first();
            $incomes = Income::where('user_id', $user->id)->get();
            return response()->json(['ststus'=>'success','incomes' => $incomes]);
        }catch (Exception $e){
            return response()->json(['ststus'=>'error','message' => $e->getMessage()]);
        }
    }


    function showBalance(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();
        return response()->json(['ststus'=>'success','balance' => $user->balance]);
    }

    //End
}

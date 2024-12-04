<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Expense;
use Illuminate\Http\Request;
use Mockery\Exception;

class ExpenseController extends Controller
{
      function addExpenses(Request $request)
{
    $userid=$request->header('id');
    try {
        Expense::create([
            'name'=>$request->input('name'),
            'user_id'=>$userid,
            'amount'=>$request->input('amount'),
            'description'=>$request->input('description'),
            'date'=>$request->input('date'),
            'receipt'=>$request->input('receipt')
        ]);
        return response()->json([
            'status'=>'success',
            'message' => 'Expense added successfully'
        ],200);

    } catch (Exception $e) {
        return response()->json([
            'status'=>'failed',
            'message' => 'Expense added Failed'
        ],200);
    }



}
}

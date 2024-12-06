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

      function updateExpenses(Request $request){
          $userid=$request->header('id');
          $expenseId=$request->input('expenseID');
          try {
              return Expense::where('id',$expenseId)->where('user_id',$userid)->update([
                  'name'=>$request->input('name'),
                  'amount'=>$request->input('amount'),
                  'description'=>$request->input('description'),
                  'date'=>$request->input('date'),
                  'receipt'=>$request->input('receipt')
              ]);
          }
          catch (Exception $e) {
              return response()->json([
                  'status'=>'failed',
                  'message' => 'Expense Update Failed'
              ],200);
          }
      }


    function ExpenseDelete(Request $request){
        $user_id=$request->header('id');
        $expense_id=$request->input('expenseID');
        return Expense::where('id',$expense_id)->where('user_id',$user_id)->delete();
    }

}

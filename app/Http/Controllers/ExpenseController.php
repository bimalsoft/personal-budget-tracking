<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class ExpenseController extends Controller
{
      function addExpenses(Request $request)
        {
            $user_id=$request->header('id');
            $user = User::where('id',$user_id)->first();

            try {
                $user->decrement('balance', $request->input('amount'));

                Expense::create([
                    'name'=>$request->input('name'),
                    'user_id'=>$user_id,
                    'category_id' => $request->input('category_id'),
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

    function getExpenses(Request $request)
    {
        $user_id=$request->header('id');
        $expense = Expense::where('user_id',$user_id)->orderBy('id','desc')->get();
        return response()->json(['ststus'=>'success','expense' => $expense]);
    }

    public function getSumExpenses(Request $request)
    {
        $user_id = $request->header('id'); // Get user ID from header
        $expense = Expense::where('user_id', $user_id)->sum('amount'); // Sum the expenses for the user

        // Return the sum in a JSON response
        return response()->json(['ststus'=>'success','expense' => $expense]);
    }


}

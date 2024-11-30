<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    function addIncome(Request $request){

        $decodedToken = JWTToken::VerifyToken($request->cookie('token'));
        return $decodedToken;
    }
}

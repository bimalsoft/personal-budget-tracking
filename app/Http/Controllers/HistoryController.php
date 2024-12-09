<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    function index(Request $request)
    {
        $data = History::where('user_id', $request->header('id'))->get();
        return response()->json(['status' => 'success', 'data' => $data],200);
    }
}

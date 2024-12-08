<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function dashboard(Request $request)
    {
        return view('pages.dashboard.dashboardPage');
    }
    function login(Request $request)
    {
        return view('pages.auth.login-page');
    }
}

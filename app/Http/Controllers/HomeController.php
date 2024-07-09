<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示
     */
    public function index()
    {
        return view('home');
    }
}

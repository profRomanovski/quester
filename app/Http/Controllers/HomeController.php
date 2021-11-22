<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $tests = auth()->user()->tests()->get();
        return view('layouts.home', compact('tests'));
    }

}

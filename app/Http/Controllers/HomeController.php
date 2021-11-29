<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $tests = auth()->user()->tests()->get();
        return view('layouts.home', compact('tests'));
    }

    public function general()
    {
        $tests = Test::all();
        return view('layouts.general',compact('tests'));
    }

    public function testSearch(Request $request)
    {
        $search = $request->post('search');
        $tests = Test::query()
            ->where('name', 'like', '%'.$search.'%')
            ->get();
        return view('layouts.general',compact('tests', 'search'));
    }

}

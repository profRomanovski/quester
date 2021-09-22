<?php

namespace App\Http\Controllers;

use App\Models\Test;

class TestController
{
    public function showTest()
    {
        return response()->json(
            auth()->user()->tests()
                ->with('questions')
                ->with('questions.answers')
                ->get()
        );
    }
}

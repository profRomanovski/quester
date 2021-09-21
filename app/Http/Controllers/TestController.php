<?php

namespace App\Http\Controllers;

use App\Models\Test;

class TestController
{
    public function showTest()
    {
        return json_encode(
            Test::query()->find(1)
                ->with('questions')
                ->with('questions.answers')
                ->get(),
            JSON_UNESCAPED_UNICODE
        );
    }
}

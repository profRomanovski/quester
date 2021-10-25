<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\JsonResponse;

class TestController
{

    /**
     * @return JsonResponse
     */
    public function userTests(): JsonResponse
    {
        return response()->json(
            auth()->user()->tests()
                ->with('questions')
                ->with('questions.answers')
                ->get()
        );
    }

    /**
     * @return JsonResponse
     */
    public function popularTests(): JsonResponse
    {
        return response()->json(
        Test::query()->with('questions')
            ->with('questions.answers')->get()
        );
    }
}

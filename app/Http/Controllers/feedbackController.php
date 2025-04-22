<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Https;

class feedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => '$required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $response = Http::post('https://hook.eu2.make.com/9n2qxsmrdrb68l3hkymfggp3akaesl82', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'message' => $response->successful()
                ? 'Thannk you for your feedback!'
                : 'Failed to submit feedback',
            'success' => $response->successful()
        ] . $response->status());
    }
}

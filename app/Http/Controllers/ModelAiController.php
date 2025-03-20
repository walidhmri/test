<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ModelAiController extends Controller
{
    public function index()
    {
        return view('oualid.test');
    }
    

    public function gemini(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY'); // Store the API key in .env file
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->input('content', 'Write a story about a magic backpack.')]
                    ]
                ]
            ]
        ]);
        Log::info("Gemini API Response: " . json_encode($response->json()));
return response()->json($response->json());
    }
}



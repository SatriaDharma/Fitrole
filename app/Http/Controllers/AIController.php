<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FitroleAIService;

class AIController extends Controller
{
    public function index()
    {
        return view('dashboard.ai');
    }

    public function ask(Request $r, FitroleAIService $ai)
    {
        $r->validate([
            'message' => 'required|string|max:1000',
        ]);

        try {
            $user = auth()->user();
            $response = $ai->ask($user, $r->message);

            return response()->json([
                'status' => 'success',
                'answer' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aduh, koneksi aku lagi keganggu nih.'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Auth;
use App\Models\MealScan;
use App\Services\BadgeService;

class MealScanController extends Controller
{
    public function index(BadgeService $badgeService)
    {
        $mealScans = auth()->user()->mealScans()->latest()->get();

        $badgeService->checkAll(Auth::user());

        return view('dashboard.meal-scan', compact('mealScans'));
    }

    public function upload(Request $request, BadgeService $badgeService)
    {
        $request->validate([
            'meal_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('meal_image')->store('meals', 'public');
        $base64Image = base64_encode(file_get_contents(storage_path("app/public/$path")));
        $apiKey = config('services.gemini.key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";

        $prompt = "Identifikasi makanan dalam gambar ini. Kamu WAJIB hanya mengembalikan objek JSON. 
        Isi bagian 'food_name' dan 'message' dengan bahasa Indonesia yang santai namun akurat.
        Format JSON: {
            \"food_name\": \"Nama Makanan\", 
            \"calories\": 100, 
            \"protein\": 10, 
            \"carbs\": 10, 
            \"fat\": 10, 
            \"message\": \"1 kalimat saran/fun fact.\"
        }. Jangan gunakan markdown.";

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url . "?key=" . $apiKey, [
                    'contents' => [
                        ['parts' => [
                            ['text' => $prompt],
                            ['inline_data' => [
                                'mime_type' => $request->file('meal_image')->getMimeType(),
                                'data' => $base64Image
                            ]]
                        ]]
                    ],
                    'generationConfig' => ['response_mime_type' => 'application/json']
                ]);

            if ($response->failed()) throw new \Exception("API Error: " . $response->body());

            $data = json_decode($response->json()['candidates'][0]['content']['parts'][0]['text'], true);
            if (json_last_error() !== JSON_ERROR_NONE) throw new \Exception("JSON Decode Error");

            $scan = auth()->user()->mealScans()->create([
                'image_path' => $path,
                'food_name' => $data['food_name'] ?? 'Unknown Food',
                'calories' => (float)($data['calories'] ?? 0),
                'protein' => (float)($data['protein'] ?? 0),
                'carbs' => (float)($data['carbs'] ?? 0),
                'fat' => (float)($data['fat'] ?? 0),
                'message' => $data['message'] ?? 'Nutrisi telah dihitung.',
            ]);

            $foodName = strtolower($data['food_name'] ?? '');
            $aiMessage = strtolower($data['message'] ?? '');
            $veggieKeywords = [
                'sayur', 'veggie', 'salad', 'bening', 'capcay', 'gado-gado', 'lotek', 
                'pecel', 'urap', 'kangkung', 'bayam', 'sawi', 'brokoli', 'wortel', 
                'buncis', 'terong', 'jamur', 'selada', 'tomat', 'timun', 'kol', 
                'kubis', 'daun', 'labu', 'pare', 'asparagus', 'rebung'
            ];

            $isVegetable = false;
            foreach ($veggieKeywords as $keyword) {
                if (str_contains($foodName, $keyword) || str_contains($aiMessage, $keyword)) {
                    $isVegetable = true;
                    break;
                }
            }

            $badgeService = new BadgeService();
            $badgeService->checkAll(auth()->user(), 'meal_scan', [
                'protein' => $data['protein'] ?? 0,
                'is_vegetable' => $isVegetable
            ]);

            return back()->with('new_scan_id', $scan->id);

        } catch (\Exception $e) {
            if (Storage::disk('public')->exists($path)) Storage::disk('public')->delete($path);
            return back()->with('error', 'Gagal menganalisis: ' . $e->getMessage());
        }

        $badgeService->checkAll(Auth::user());

    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FitroleAIService
{
    protected $apiKey;
    protected $model;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->model = config('gemini-2.5-flash');
    }

    public function ask($user, $question)
    {
        $profile = $user->profile;
        $logs = DB::table('progress_logs')
            ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        $context = "Profil pengguna:\n";
        $context .= "- Jenis kelamin: " . ($profile->gender ?? 'Tidak diketahui') . "\n";
        $context .= "- Tanggal lahir: " . ($profile->birth_date ?? 'Tidak diketahui') . "\n";
        $context .= "- Umur: " . ($profile->age ?? 'Tidak diketahui') . "\n";
        $context .= "- Tinggi: " . ($profile->height_cm ?? '-') . " cm\n";
        $context .= "- Berat: " . ($profile->weight_kg ?? '-') . " kg\n";
        $context .= "- Tingkat aktivitas: " . ($profile->activity_level ?? 'Tidak diketahui') . " cm\n";
        $context .= "- Pekerjaan: " . ($profile->job ?? '-') . " Tidak diketahui\n";
        $context .= "- Program: " . ($profile->target_program ?? '-') . " Tidak diketahui\n";
        $context .= "- Target berat: " . ($profile->target_weight ?? '-') . " Tidak diketahui\n";

        foreach ($logs as $l) {
            $context .= "- {$l->date}: {$l->weight_kg} kg\n";
        }

        $prompt = "
            Kamu adalah Fitrole AI, asisten kebugaran yang santai, humoris, dan sangat memotivasi.
            Jawab pertanyaan user menggunakan data konteks berikut:

            === KONTEKS USER ===
            $context

            === PERTANYAAN USER ===
            $question

            === INSTRUKSI FORMATTING (WAJIB) ===
            1. Gunakan Bahasa Indonesia yang gaul, santai, tapi tetap informatif.
            2. WAJIB memberikan jarak antar paragraf (double newline) agar teks tidak rapat.
            3. Gunakan simbol atau Emoji yang relevan di setiap poin agar menarik.
            4. Gunakan Bold (**) untuk istilah penting atau angka.
            5. Jika memberikan daftar tips, gunakan format Bullet Points (-) atau penomoran yang rapi.
            6. Berikan kalimat penutup yang memotivasi di akhir jawaban.
            7. Jangan pernah mengirim jawaban yang terpotong di tengah kalimat.
        ";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}{$this->model}:generateContent?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 2048,
                    'topP' => 0.9,
                ],
                'safetySettings' => [
                    ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_NONE'],
                    ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_NONE'],
                    ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_NONE'],
                    ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_NONE'],
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $candidate = $data['candidates'][0] ?? null;
                
                if ($candidate) {
                    $parts = $candidate['content']['parts'] ?? [];
                    $fullText = '';
                    foreach ($parts as $part) {
                        $fullText .= $part['text'] ?? '';
                    }

                    if (!empty($fullText)) {
                        return $fullText;
                    }
                }

                if (isset($candidate['finishReason']) && $candidate['finishReason'] === 'SAFETY') {
                    return "Aduh, maaf banget! Jawaban tadi terpotong karena masalah kebijakan keamanan konten. Coba tanya hal lain yuk!";
                }
                
                return "Duh, sinyal otak AI lagi agak lemot. Bisa diulang pertanyaannya?";
            }

            Log::error("Gemini API Error: " . $response->body());
            return "Server lagi penuh nih, bro. Coba lagi sedetik kemudian ya!";

        } catch (\Exception $e) {
            Log::error("Fitrole Service Error: " . $e->getMessage());
            return "Waduh, ada kendala teknis. Semangat terus olahraganya!";
        }
    }
}
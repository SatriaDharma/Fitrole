<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            
            [
                'name' => 'First Entry',
                'category' => 'Dedikasi',
                'code' => '1ST_TIME',
                'description' => 'Berhasil mengisi berat badan pertama kali.',
                'icon_path' => 'badges/1st-entry.png'
            ],
            [
                'name' => '7 Streak',
                'category' => 'Dedikasi',
                'code' => '7_STREAK',
                'description' => 'Mengisi data berat badan 7 hari berturut-turut tanpa putus.',
                'icon_path' => 'badges/7-streak.png'
            ],
            [
                'name' => '3 Months',
                'category' => 'Dedikasi',
                'code' => '3_MONTHS',
                'description' => 'Mengisi data berat badan 90 hari berturut-turut.',
                'icon_path' => 'badges/3-months.png'
            ],
            [
                'name' => 'Weekend Warrior',
                'category' => 'Dedikasi',
                'code' => 'WEEKEND',
                'description' => 'Tetap disiplin mengisi data di hari Sabtu dan Minggu.',
                'icon_path' => 'badges/weekend.png'
            ],
            [
                'name' => '1st Step',
                'category' => 'Pencapaian',
                'code' => '1ST_STEP',
                'description' => 'Berhasil turun 1 kg pertama. Langkah awal yang luar biasa!',
                'icon_path' => 'badges/1st-step.png'
            ],
            [
                'name' => 'High Five',
                'category' => 'Pencapaian',
                'code' => 'HIGH_FIVE',
                'description' => 'Berhasil turun 5 kg dari berat awal. Toss dulu!',
                'icon_path' => 'badges/high-five.png'
            ],
            [
                'name' => 'On Fire',
                'category' => 'Pencapaian',
                'code' => 'ON_FIRE',
                'description' => 'Pencapaian progres yang sangat cepat dalam waktu singkat.',
                'icon_path' => 'badges/on-fire.png'
            ],
            [
                'name' => 'Ideal Soul',
                'category' => 'Pencapaian',
                'code' => 'IDEAL_SOUL',
                'description' => 'BMI menyentuh angka Normal untuk pertama kalinya.',
                'icon_path' => 'badges/ideal-soul.png'
            ],
            [
                'name' => 'Meal Scan Mastery',
                'category' => 'AI Foodie',
                'code' => 'MEAL_SCAN',
                'description' => 'Pertama kali menggunakan fitur AI Meal Scanner.',
                'icon_path' => 'badges/meal-scan.png'
            ],
            [
                'name' => 'Proteinmen',
                'category' => 'AI Foodie',
                'code' => 'PROTEINMEN',
                'description' => 'Makan makanan dengan protein tinggi (>35g) dalam satu porsi.',
                'icon_path' => 'badges/proteinmen.png'
            ],
            [
                'name' => 'Veggiemen',
                'category' => 'AI Foodie',
                'code' => 'VEGGIEMEN',
                'description' => 'Mengkonsumsi sayuran 3 hari berturut-turut yang terdeteksi AI.',
                'icon_path' => 'badges/veggiemen.png'
            ],
            [
                'name' => 'Night Owl',
                'category' => 'Easter Egg',
                'code' => 'NIGHT_OWL',
                'description' => 'Melakukan input data atau chat AI di atas jam 12 malam.',
                'icon_path' => 'badges/night-owl.png'
            ],
            [
                'name' => 'Healthday',
                'category' => 'Easter Egg',
                'code' => 'HEALTHDAY',
                'description' => 'Tetap peduli kesehatan di hari libur nasional.',
                'icon_path' => 'badges/healthday.png'
            ],
            [
                'name' => 'Finish It!',
                'category' => 'Easter Egg',
                'code' => 'FINISH_IT',
                'description' => 'Selamat! Kamu telah mencapai target berat badan impianmu.',
                'icon_path' => 'badges/finish-it.png'
            ]
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(['code' => $badge['code']], $badge);
        }
    }
}
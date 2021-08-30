<?php

namespace Database\Seeders;

use App\Models\Fund;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $user_id = 1;
        Fund::create([
            'user_id' => $user_id,
            'status' => 'verify',
            'kota' => 'Tangerang',
            'judul' =>
            'Galang Dana Untuk Palestina Bersam HMI KOMFAKTEK',
            'goal_amount' => $faker->randomNumber($nbDigits = 7, $strict = false),
            'alamat' => $faker->address,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),
            'deskripsi' => 'Asosiasi Kesejahteraan Muslim Worcester (WMWA) berupaya menggalang dana untuk membangun masjid baru di Stanley Road. Total dana yang dibutuhkan untuk masjid ini adalah 3,5 juta Poundsterling atau Rp 70,7 miliar.
                            Proses penggalangan dana ini sempat terhenti selama pandemi, ketika tempat-tempat ibadah harus ditutup. Kini, upaya ini kembali dilanjutkan',
            'thumbnail' => 'https://gusti-hmi-komfaktek-v-beta-1.netlify.app/public/image/Instagram%20post%20-%207.png'
        ]);
        Fund::create([
            'user_id' => $user_id,
            'status' => 'verify',
            'judul' =>
            $faker->sentence($nbWords = 5, $variableNbWords = true),
            'goal_amount' => $faker->randomNumber($nbDigits = 7, $strict = false),
            'alamat' => $faker->address,
            'kota' => $faker->city,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),
            'deskripsi' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
            'thumbnail' => 'https://source.unsplash.com/349x176/?earthquake/8'
        ]);
        for ($i = 1; $i < 5; $i++) {
            Fund::create([
                'user_id' => $user_id + 1,
                'status' => 'verify',
                'judul' =>
                $faker->sentence($nbWords = 5, $variableNbWords = true),
                'goal_amount' => $faker->randomNumber($nbDigits = 7, $strict = false),
                'alamat' => $faker->address,
                'kota' => $faker->city,
                'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),
                'deskripsi' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
                'thumbnail' => 'https://source.unsplash.com/349x176/?earthquake/' . $i
            ]);
        }
    }
}

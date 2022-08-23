<?php

namespace Database\Seeders;

use App\Models\Tulisan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TulisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i < 10; $i++) {
            if ($i % 2 < 1) {
                Tulisan::create([
                    'user_id' => 1,
                    'kategori_tulisan_id' => 1,
                    'image' => 'https://source.unsplash.com/349x176/?nature/' . $i,
                    'judul' =>
                    $faker->sentence($nbWords = 5, $variableNbWords = true),
                    'teks' =>
                    $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
                ]);
            } else {
                Tulisan::create([
                    'user_id' => 1,
                    'kategori_tulisan_id' => 2,
                    'image' => 'https://source.unsplash.com/349x176/?nature/' . $i,
                    'judul' =>
                    $faker->sentence($nbWords = 5, $variableNbWords = true),
                    'teks' =>
                    $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
                ]);
            }
        }
    }
}

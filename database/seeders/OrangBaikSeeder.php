<?php

namespace Database\Seeders;

use App\Models\OrangBaik;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrangBaikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $user_id = 2;
        $fund_id = 1;
        OrangBaik::create([
            'user_id' => $user_id,
            'fund_id' => $fund_id,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
        OrangBaik::create([
            'user_id' => $user_id,
            'fund_id' => $fund_id++,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
        OrangBaik::create([
            'user_id' => $user_id++,
            'fund_id' => $fund_id + 3,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
        OrangBaik::create([
            'user_id' => $user_id + 2,
            'fund_id' => $fund_id + 3,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
        OrangBaik::create([
            'user_id' => $user_id + 2,
            'fund_id' => $fund_id + 1,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
        OrangBaik::create([
            'user_id' => $user_id + 2,
            'fund_id' => $fund_id,
            'current_amout' => $faker->randomNumber($nbDigits = 5, $strict = false),

        ]);
    }
}

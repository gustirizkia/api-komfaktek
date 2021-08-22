<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\JoinEvent;
use App\Models\Moderator;
use App\Models\Pemateri;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        User::create([
            'name' => 'Gusti Maulana Rizkia',
            'email' => 'gustirizkia4@gmail.com',
            'password' => Hash::make('admin'),
            'roles' => 'admin'
        ]);

        for ($i = 1; $i < 30; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
            ]);
        }

        $mulai = Carbon::now()->addWeeks();
        for ($i = 1; $i < 6; $i++) {
            Event::create([
                'nama' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'image' => 'https://lorempixel.com/310/310/technics/',
                'mulai' => $mulai,
                'deskripsi' => $faker->paragraph($nbSentences = 120, $variableNbSentences = true)
            ]);
        }
        for ($i = 1; $i < 6; $i++) {
            Pemateri::create([
                'event_id' => $i,
                'nama' => $faker->name,
                'image' => 'https://lorempixel.com/200/200/people/',
                'title' => $faker->jobTitle . ', ' . $faker->company,
                'email' => $faker->email,
                'alamat' => $faker->address
            ]);
        }

        for ($i = 1; $i < 6; $i++) {
            Moderator::create([
                'event_id' => $i,
                'user_id' => $i
            ]);
        }

        for ($i = 1; $i < 6; $i++) {
            for ($j = 1; $j < 4; $j++) {
                JoinEvent::create([
                    'event_id' => $i,
                    'user_id' => $i
                ]);
            }
        }
    }
}

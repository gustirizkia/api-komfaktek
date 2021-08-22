<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\JoinEvent;
use App\Models\Kategori;
use App\Models\Moderator;
use App\Models\Pemateri;
use App\Models\User;
use App\Models\UserDetail;
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

        for ($i = 0; $i < 4; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
            ]);
        }
        for ($i = 1; $i < 6; $i++) {
            UserDetail::create([
                'user_id' => $i,
                'alamat' => $faker->address,
                'profesi' => $faker->jobTitle . ', ' . $faker->company
            ]);
        }

        for ($i = 0; $i < 4; $i++) {
            Kategori::create([
                'nama' => $faker->word
            ]);
        }

        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 4; $j++) {
                $mulai = Carbon::now()->addDay(3 + $j);
                Event::create([
                    'kategori_id' => $i,
                    'nama' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'image' => 'https://lorempixel.com/310/310/technics/',
                    'mulai' => $mulai,
                    'deskripsi' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true)
                ]);
            }
        }

        for ($i = 1; $i < 4; $i++) {
            Pemateri::create([
                'event_id' => $i,
                'nama' => $faker->name,
                'image' => 'https://lorempixel.com/200/200/people/',
                'title' => $faker->jobTitle . ', ' . $faker->company,
                'email' => $faker->email,
                'alamat' => $faker->address
            ]);
        }

        for ($i = 1; $i < 4; $i++) {
            Moderator::create([
                'event_id' => $i,
                'user_id' => $i
            ]);
        }

        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 4; $j++) {
                JoinEvent::create([
                    'event_id' => $i,
                    'user_id' => $i,
                    'status' => 'sukses'
                ]);
            }
        }
    }
}

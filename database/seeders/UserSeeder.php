<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\JoinEvent;
use App\Models\Kategori;
use App\Models\Moderator;
use App\Models\Pemateri;
use App\Models\Rekening;
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
        User::create([
            'name' => 'Super Admin Komfaktek',
            'email' => 'admin@komfaktek.com',
            'password' => Hash::make('admin 2021'),
            'roles' => 'super admin'
        ]);
        UserDetail::create([
            'user_id' => 6,
            'alamat' => $faker->address,
            'profesi' => $faker->jobTitle . ', ' . $faker->company
        ]);

        for ($i = 0; $i < 4; $i++) {
            Kategori::create([
                'nama' => $faker->word
            ]);
        }
        $p = 1;
        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 4; $j++) {
                $mulai = Carbon::now()->addDay(3 + $j);
                Event::create([
                    'kategori_id' => $i,
                    'nama' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'image' => 'https://source.unsplash.com/349x176/?school/' . $p,
                    'mulai' => $mulai,
                    'deskripsi' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true)
                ]);
                $p++;
            }
        }
        $no = 0;
        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 4; $j++) {
                $no += 1;
                Pemateri::create([
                    'event_id' => $no,
                    'nama' => $faker->name,
                    'image' => 'https://source.unsplash.com/349x176/?people/',
                    'title' => $faker->jobTitle . ', ' . $faker->company,
                    'email' => $faker->email,
                    'alamat' => $faker->address
                ]);
            }
        }

        $no = 0;
        for ($i = 1; $i < 4; $i++) {

            for ($j = 1; $j < 4; $j++) {
                $no += 1;
                Moderator::create([
                    'event_id' => $no,
                    'user_id' => $i
                ]);
            }
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

        Rekening::create([
            "nama_bank" => "BRI",
            "nomor_bank" => "11092121",
            "atas_nama" => "HMI KOMFAKTEK"
        ]);
        Rekening::create([
            "nama_bank" => "BCA",
            "nomor_bank" => "0911278",
            "atas_nama" => "HMI KOMFAKTEK"
        ]);
    }
}

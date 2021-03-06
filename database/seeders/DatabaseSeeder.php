<?php

namespace Database\Seeders;

use App\Models\CampaigImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            KategoriTulisanSeeder::class,
            TulisanSeeder::class,
            FoundSeeder::class,
            OrangBaikSeeder::class,
        ]);
    }
}

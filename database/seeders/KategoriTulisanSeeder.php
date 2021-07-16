<?php

namespace Database\Seeders;

use App\Models\KategoriTulisan;
use Illuminate\Database\Seeder;

class KategoriTulisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriTulisan::create([
            'nama' => 'sejarah'
        ]);
        KategoriTulisan::create([
            'nama' => 'HMI'
        ]);
    }
}

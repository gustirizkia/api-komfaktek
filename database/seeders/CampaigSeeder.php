<?php

namespace Database\Seeders;

use App\Models\Campaig;
use Illuminate\Database\Seeder;

class CampaigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 6; $i++) {
            Campaig::create([
                'user_id' => 1,
                'nama' => 'Qurban bersama Rakyat Pamulang',
                'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque hic quasi illo maiores natus porro qui autem corporis vero labore?',
                'goal_amount' => 1000000,
                'current_amout' => 500000,
                'alamat' => 'pamulang pondok benda',
                'provinsi' => 'banten',
                'kota' => 'Tangerang Selatan'
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Campaig;
use App\Models\CampaigImage;
use Illuminate\Database\Seeder;

class CampaigImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countCampaig = Campaig::count();
        for ($i = 1; $i <= $countCampaig; $i++) {
            CampaigImage::create([
                'campaig_id' => $i,
                'img_path' => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YW5pbWFsfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60',
            ]);
        }
    }
}

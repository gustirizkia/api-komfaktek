<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gusti Maulana Rizkia',
            'email' => 'gustirizkia4@gmail.com',
            'password' => '220900',
            'roles' => 'admim'
        ]);
    }
}

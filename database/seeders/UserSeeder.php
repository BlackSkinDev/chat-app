<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'username' =>'afeez_dev',
            'email'    =>'azeezafeez212@gmail.com',
            'email_verified_at' => now(),
            'password' =>'12345678',
        ]);

        User::create([
            'username' =>'chilling_dev',
            'email'    =>'chilling@chillingdev.com',
            'email_verified_at' => now(),
            'password' =>'12345678',
        ]);
    }
}

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
            'password' =>'12345678',
            'avatar'   => config('app.url')."/images/avatar.png"
        ]);

        User::create([
            'username' =>'chilling_dev',
            'email'    =>'chilling@chillingdev.com',
            'password' =>'12345678',
            'avatar'   => config('app.url')."/images/avatar.png"
        ]);
    }
}

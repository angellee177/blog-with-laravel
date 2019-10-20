<?php

use App\User;
use App\Admin;
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
            'name' => 'Joker',
            'email' => 'Joker19@yopmail.com',
            'password' => Hash::make('password'),
        ]);
       
        Admin::create([
            'name' => 'admin',
            'email' => 'leexiao62@yopmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}

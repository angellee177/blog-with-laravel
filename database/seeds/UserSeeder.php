<?php

use App\User;
use App\Article;
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
        $user = factory(App\User::class, 3)
           ->create()
           ->each(function ($user) {
                $user->article()->createMany(factory(App\Article::class, 3)->make()->toArray());
            });

        User::create([
                'name' => 'Joker',
                'email' => 'Joker19@yopmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now()
        ]);

        Admin::create([
            'name' => 'admin',
            'email' => 'leexiao62@yopmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}

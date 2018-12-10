<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@mail.com',
            'avatar' => asset('avatars/avatar.png'),
            'admin' => 1
        ]);
    }
}

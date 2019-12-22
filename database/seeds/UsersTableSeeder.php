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
            'title' => 'Professor',
            'name' => 'Severus Snape',
            'email' => 'snape@slytherin.org',
            'email_verified_at' => now(),
            'password' => 'secret',
        ]);
    }
}

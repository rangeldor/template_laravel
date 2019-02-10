<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Oliveira',
            'email' => 'rangeldor@gmail.com',
            'password' => bcrypt('master19'),
        ]);

    }
}

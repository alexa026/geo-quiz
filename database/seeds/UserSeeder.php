<?php

use App\User;
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
        $users = array(
            ['name' => 'Pera', 'email' => 'test@test.com', 'password' => Hash::make('test')],
            ['name' => 'Mika', 'email' => 'test1@test.com', 'password' => Hash::make('test')],
            ['name' => 'Zika', 'email' => 'test2@test.com', 'password' => Hash::make('test')],
            ['name' => 'Laza', 'email' => 'test3@test.com', 'password' => Hash::make('test')],
        );

        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}

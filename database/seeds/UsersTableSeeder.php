<?php

namespace Database\Seeds;

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
        DB::table('users')->insert(
            [
                'email' => 'vladimirInvestments@gmail.com',
                'password' => bcrypt('test123!'),
                'first_name' => 'Vladimir',
                'last_name' => 'Grujin',
                'gender' => 'male',
                'country' => 'Serbia',
                'state' => 'Vojvodina',
                'city' => 'Novi Sad',
            ]
        );

        DB::table('users')->insert(
            [
                'email' => 'milosInvestor@gmail.com',
                'password' => bcrypt('test123!'),
                'first_name' => 'Milos',
                'last_name' => 'Jandric',
                'gender' => 'male',
                'country' => 'Serbia',
                'state' => 'Vojvodina',
                'city' => 'Novi Sad',
            ]
        );
    }
}

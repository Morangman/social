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
        // check if table users is empty
        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([

                [
                    'nick' => 'nIck',
                    'name' => 'Nick Coolman',
                    'photo' => 'images/1/Nick.jpg',
                    'email' => 'nicki@mail.com',
                    'phone' => '+380993224545',
                    'password' => bcrypt('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nick' => 'alex',
                    'name' => 'Alex Root',
                    'photo' => 'images/2/Alex.jpg',
                    'email' => 'alex@mail.com',
                    'phone' => '+380993224545',
                    'password' => bcrypt('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nick' => 'moon',
                    'name' => 'Eliza Moon',
                    'photo' => 'images/3/Eliza.jpg',
                    'email' => 'lizza@gmail.com',
                    'phone' => '+380993224545',
                    'password' => bcrypt('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nick' => 'lara',
                    'name' => 'Otwel Laravel',
                    'photo' => 'images/4/Otwel.jpg',
                    'email' => 'otv@gmail.com',
                    'phone' => '+380993224545',
                    'password' => bcrypt('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}

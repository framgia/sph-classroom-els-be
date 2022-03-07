<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'John Doe',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Calvin Harris',
                'email' => 'calvin@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Bruce Wayne',
                'email' => 'bruce@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Tony Stark',
                'email' => 'tonystark@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Mark Zuckerberg',
                'email' => 'markz@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Charles Babbage',
                'email' => 'charles@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Dennis Ritchie',
                'email' => 'dennis@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Jon Bellion',
                'email' => 'jon@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Ryan Reynolds',
                'email' => 'ryanreynolds@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Peter Parker',
                'email' => 'peterparker@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Stephen Strange',
                'email' => 'strange@gmail.com@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'name' => 'Diana Prince',
                'email' => 'dianaprince@gmail.com@gmail.com',
                'password' => bcrypt('password'),
                'user_type_id' => 1,
                'avatar' => 'avatar.jpg',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];
        
        DB::table('users')->insert($admins);
    }
}

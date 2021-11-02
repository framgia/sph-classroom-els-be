<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'user_type' => 'Admin',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'user_type' => 'Student',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}

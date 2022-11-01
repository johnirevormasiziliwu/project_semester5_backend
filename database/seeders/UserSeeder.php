<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'us_name' => 'Admin',
            'us_email'=> 'admin@mail.com',
            'us_password' => password_hash('admin', PASSWORD_DEFAULT) 
        ]);
    }
}
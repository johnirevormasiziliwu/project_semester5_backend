<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'us_name' => 'David Kristian Ziliwu',
            'us_email'=> 'davidkristian@gmail.com',
            'us_password' => password_hash('admin', PASSWORD_DEFAULT) 
        ]);
        DB::table('users')->insert([
            'us_name' => 'Rickyi Martin Ziliwu',
            'us_email'=> 'rickyimartin@gmail.com',
            'us_password' => password_hash('admin', PASSWORD_DEFAULT) 
        ]);
    }
}
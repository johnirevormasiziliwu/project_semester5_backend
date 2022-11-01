<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([

            'pr_code' =>'PR001',
            'pr_name' => 'Mouse Logittech',
            'pr_price' => 98000,
        ]);
        
        DB::table('products')->insert([
            'pr_code' =>'PR002',
            'pr_name' => 'Mouse',
            'pr_price' => 98000,
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Date;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Java 8 - An introduction',
                'description' => 'Good book by Deitel',
                'quantity' => 3,
                'price' => 100.00,
                'category_id' => 1,
                'created_at' => Date::now()->toString()
            ],
            [
                'name' => 'Design Patterns',
                'description' => 'Some of the most successful patterns on enterprise applications!',
                'quantity' => 5,
                'price' => 75.00,
                'category_id' => 1,
                'created_at' => Date::now()->toString()
            ],
            [
                'name' => 'Mac Book Pro',
                'description' => 'Nothing to say! Its Apple baby!',
                'quantity' => 2,
                'price' => 900.00,
                'category_id' => 2,
                'created_at' => Date::now()->toString()
            ],
        ]);
    }
}

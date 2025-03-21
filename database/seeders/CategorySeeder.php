<?php

namespace Database\Seeders;

use Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Books',
            'description' => 'Some cool programming books!',
            'created_at' => Date::now()->toString()
        ]);

    }
}

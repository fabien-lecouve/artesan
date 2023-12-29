<?php

namespace Database\Seeders;

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
        // Category::factory(4)->create();
        $categories = [
            [
                'user_id' => 1,
                'name' => 'prise de courant'
            ],
            [
                'user_id' => 1,
                'name' => 'circuit éclairage'
            ],
            [
                'user_id' => 1,
                'name' => 'prise de communication'
            ],
            [
                'user_id' => 1,
                'name' => 'tableau électrique'
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}

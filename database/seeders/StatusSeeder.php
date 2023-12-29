<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'proposé', 'slug' => 'offered'],
            ['name' => 'validé', 'slug' => 'validated'],
            ['name' => 'terminé', 'slug' => 'terminated'],
            ['name' => 'annulé', 'slug' => 'canceled'],
        ];
        DB::table('statuses')->insert($status);
    }
}

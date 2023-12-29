<?php

namespace Database\Seeders;

use App\Models\Estimate;
use App\Models\Material;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estimate::factory(50)
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Price::factory(40)->create();
        $prices = [
            [
                'material_id' => 1,
                'mode_of_work_id' => 1,
                'unit_price' => 40,
                'workforce_price' => 50,
            ],
            [
                'material_id' => 2,
                'mode_of_work_id' => 1,
                'unit_price' => 45,
                'workforce_price' => 65,
            ],
            [
                'material_id' => 3,
                'mode_of_work_id' => 1,
                'unit_price' => 40,
                'workforce_price' => 55,
            ],
            [
                'material_id' => 4,
                'mode_of_work_id' => 1,
                'unit_price' => 45,
                'workforce_price' => 85,
            ],
            [
                'material_id' => 5,
                'mode_of_work_id' => 1,
                'unit_price' => 45,
                'workforce_price' => 70,
            ],
            [
                'material_id' => 6,
                'mode_of_work_id' => 1,
                'unit_price' => 40,
                'workforce_price' => 70,
            ],
            [
                'material_id' => 7,
                'mode_of_work_id' => 1,
                'unit_price' => 0,
                'workforce_price' => 375,
            ],
            [
                'material_id' => 8,
                'mode_of_work_id' => 1,
                'unit_price' => 0,
                'workforce_price' => 525,
            ],
            [
                'material_id' => 9,
                'mode_of_work_id' => 1,
                'unit_price' => 0,
                'workforce_price' => 650,
            ],
            [
                'material_id' => 10,
                'mode_of_work_id' => 1,
                'unit_price' => 0,
                'workforce_price' => 875,
            ],
            [
                'material_id' => 1,
                'mode_of_work_id' => 2,
                'unit_price' => 45,
                'workforce_price' => 100,
            ],
            [
                'material_id' => 2,
                'mode_of_work_id' => 2,
                'unit_price' => 55,
                'workforce_price' => 115,
            ],
            [
                'material_id' => 3,
                'mode_of_work_id' => 2,
                'unit_price' => 45,
                'workforce_price' => 10,
            ],
            [
                'material_id' => 4,
                'mode_of_work_id' => 2,
                'unit_price' => 60,
                'workforce_price' => 145,
            ],
            [
                'material_id' => 5,
                'mode_of_work_id' => 2,
                'unit_price' => 60,
                'workforce_price' => 100,
            ],
            [
                'material_id' => 6,
                'mode_of_work_id' => 2,
                'unit_price' => 50,
                'workforce_price' => 100,
            ],
            [
                'material_id' => 7,
                'mode_of_work_id' => 2,
                'unit_price' => 0,
                'workforce_price' => 425,
            ],
            [
                'material_id' => 8,
                'mode_of_work_id' => 2,
                'unit_price' => 0,
                'workforce_price' => 625,
            ],
            [
                'material_id' => 9,
                'mode_of_work_id' => 2,
                'unit_price' => 0,
                'workforce_price' => 825,
            ],
            [
                'material_id' => 10,
                'mode_of_work_id' => 2,
                'unit_price' => 0,
                'workforce_price' => 1050,
            ],
        ];
        DB::table('prices')->insert($prices);
    }
}

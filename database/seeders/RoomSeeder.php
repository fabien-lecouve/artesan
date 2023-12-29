<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'chambre',
                'complementary_name' => ''
            ],
            [
                'name' => 'salon',
                'complementary_name' => ''
            ],
            [
                'name' => 'cuisine',
                'complementary_name' => ''
            ],
            [
                'name' => 'salle de bain',
                'complementary_name' => ''
            ],
            [
                'name' => 'WC',
                'complementary_name' => ''
            ],
            [
                'name' => 'couloir',
                'complementary_name' => ''
            ],
            [
                'name' => 'entrée',
                'complementary_name' => ''
            ],
            [
                'name' => 'escaliers',
                'complementary_name' => ''
            ],
            [
                'name' => 'garage',
                'complementary_name' => ''
            ],
            [
                'name' => 'extérieur',
                'complementary_name' => ''
            ],
        ];
        DB::table('rooms')->insert($rooms);
    }
}

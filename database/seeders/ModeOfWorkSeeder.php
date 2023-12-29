<?php

namespace Database\Seeders;

use App\Models\ModeOfWork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeOfWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modes = [
            ['name' => 'neuf ou rénovation sous doublage'],
            ['name' => 'rénovation sous saignée'],
        ];
        DB::table('mode_of_works')->insert($modes);
    }
}

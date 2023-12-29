<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Material::factory(20)->create();
        $materials = [
            [
                'name' => 'prise 16A',
                'category_id' => 1,
                'user_id' => 1,
                'description' => 'Création d\'un circuit électrique composé d\' une prise de courant',
                'start_of_description_for_several' => 'Création d\'un circuit électrique composé de',
                'end_of_description_for_several' => 'prises de courant',
            ],
            [
                'name' => 'prise 16A double',
                'category_id' => 1,
                'user_id' => 1,
                'description' => 'Création d\'une double prise de courant',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => 'simple allumage',
                'category_id' => 2,
                'user_id' => 1,
                'description' => 'Création d\'un circuit lumineux commandé par un simple interrupteur',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => 'double allumage',
                'category_id' => 2,
                'user_id' => 1,
                'description' => 'Création d\'un double circuit lumineux commandé par un double interrupteur',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => 'prise RJ45',
                'category_id' => 3,
                'user_id' => 1,
                'description' => 'Création d\'une prise RJ45',
                'start_of_description_for_several' => 'Création de',
                'end_of_description_for_several' => 'prises RJ45',
            ],
            [
                'name' => 'prise TV',
                'category_id' => 3,
                'user_id' => 1,
                'description' => 'Création d\'une prise TV',
                'start_of_description_for_several' => 'Création de',
                'end_of_description_for_several' => 'prises TV',
            ],
            [
                'name' => '1 rangée',
                'category_id' => 4,
                'user_id' => 1,
                'description' => 'Fourniture et pose d\'un tableau électrique (1 rangée) et de ses composants : Interrupteurs différentiel / Disjoncteurs divisionnaires / Accessoires de raccordement',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => '2 rangées',
                'category_id' => 4,
                'user_id' => 1,
                'description' => 'Fourniture et pose d\'un tableau électrique (2 rangées) et de ses composants : Interrupteurs différentiel / Disjoncteurs divisionnaires / Accessoires de raccordement',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => '3 rangées',
                'category_id' => 4,
                'user_id' => 1,
                'description' => 'Fourniture et pose d\'un tableau électrique (3 rangées) et de ses composants : Interrupteurs différentiel / Disjoncteurs divisionnaires / Accessoires de raccordement',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
            [
                'name' => '4 rangées',
                'category_id' => 4,
                'user_id' => 1,
                'description' => 'Fourniture et pose d\'un tableau électrique (4 rangées) et de ses composants : Interrupteurs différentiel / Disjoncteurs divisionnaires / Accessoires de raccordement',
                'start_of_description_for_several' => '',
                'end_of_description_for_several' => '',
            ],
        ];
        DB::table('materials')->insert($materials);
    }
}

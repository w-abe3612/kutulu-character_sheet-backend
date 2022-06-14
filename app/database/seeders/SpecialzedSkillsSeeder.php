<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\SpecialzedSkills;
use Illuminate\Support\Facades\DB;

class SpecialzedSkillsSeeder extends Seeder
{

    private $datas = [
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '人類学&民族学',
            'skill_param' =>  'anthropology',
            'skill_value' =>  0,
            'skill_order' =>  0,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '図書館&古文書学',
            'skill_param' =>  'library',
            'skill_value' =>  0,
            'skill_order' =>  1,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '芸術&工芸',
            'skill_param' =>  'artistry',
            'skill_value' =>  0,
            'skill_order' =>  2,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '医学',
            'skill_param' =>  'medical',
            'skill_value' =>  0,
            'skill_order' =>  3,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '自然科学',
            'skill_param' =>  'science',
            'skill_value' =>  0,
            'skill_order' =>  4,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '心理学',
            'skill_param' =>  'psychology',
            'skill_value' =>  0,
            'skill_order' =>  5,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '考古学&歴史学',
            'skill_param' =>  'archeology',
            'skill_value' =>  0,
            'skill_order' =>  6,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '経済学&法学',
            'skill_param' =>  'economics',
            'skill_value' =>  0,
            'skill_order' =>  7,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '犯罪学',
            'skill_param' =>  'criminology',
            'skill_value' =>  0,
            'skill_order' =>  8,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '機械工学',
            'skill_param' =>  'engineering',
            'skill_value' =>  0,
            'skill_order' =>  9,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  'オカルト',
            'skill_param' =>  'occult',
            'skill_value' =>  0,
            'skill_order' =>  10,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '言語学',
            'skill_param' =>  'linguistics',
            'skill_value' =>  0,
            'skill_order' =>  11,
        ),
    ];


    // todo 挿入用のロジックを作成

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialzed_skills')->insert( $this->datas );
    }
}

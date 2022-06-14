<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AbilityValuesSeeder extends Seeder
{
    private $datas = [
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '名声',
            'skill_param' => 'prestige',
            'skill_value' => 0,
            'skill_type' => 0,
            'skill_order' => 0,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '弁舌',
            'skill_param' => 'speech',
            'skill_value' => 0,
            'skill_type' => 0,
            'skill_order' => 1,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '信用',
            'skill_param' => 'credit',
            'skill_value' => 0,
            'skill_type' => 0,
            'skill_order' => 2,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '家格',
            'skill_param' => 'parentage',
            'skill_value' => 0,
            'skill_type' => 0,
            'skill_order' => 3,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '射撃',
            'skill_param' => 'shooting',
            'skill_value' => 0,
            'skill_type' => 1,
            'skill_order' => 0,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '白兵',
            'skill_param' => 'combat',
            'skill_value' => 0,
            'skill_type' => 1,
            'skill_order' => 1,
        ),
        
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '隠密',
            'skill_param' => 'undercover',
            'skill_value' => 0,
            'skill_type' => 1,
            'skill_order' => 2,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '敏捷',
            'skill_param' => 'nimble',
            'skill_value' => 0,
            'skill_type' => 1,
            'skill_order' => 3,
        ),
        array(
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' => '筋力',
            'skill_param' => 'strength',
            'skill_value' => 0,
            'skill_type' => 1,
            'skill_order' => 4,
        ),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ability_values')->insert($this->datas);
    }
}

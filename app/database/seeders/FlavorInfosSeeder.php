<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\FlavorInfos;
use Illuminate\Support\Facades\DB;

class FlavorInfosSeeder extends Seeder
{

    private $datas = [
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '職業',
        'flavor_info_param' =>  'occupation',
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  0,
    ),
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '年齢', 
        'flavor_info_param' =>  'age', 
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  1,
    ),
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '性別', 
        'flavor_info_param' =>  'sex', 
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  2,
    ),
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '出身地', 
        'flavor_info_param' =>  'birthplace', 
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  3,
    ),
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '身長', 
        'flavor_info_param' =>  'height', 
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  4,
    ),
    array(
        'character_info_id' => 1,
        'user_id' => 1,
        'flavor_info_name' =>  '体重', 
        'flavor_info_param' =>  'weight', 
        'flavor_info_value' =>  '', 
        'flavor_info_order' =>  5,
    )
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flavor_infos')->insert($this->datas);
    }
}

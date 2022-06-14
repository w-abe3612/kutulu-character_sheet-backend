<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CharacterInfos;

class CharacterInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CharacterInfos::factory()->count(5)->create();
    }
}

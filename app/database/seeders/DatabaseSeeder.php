<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeedder::class);
        $this->call(CharacterInfosSeeder::class);
        $this->call(AbilityValuesSeeder::class);
        $this->call(FlavorInfosSeeder::class);
        $this->call(SpecialzedSkillsSeeder::class);
    }
}

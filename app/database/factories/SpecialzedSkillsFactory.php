<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialzedSkillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'character_info_id' => 1,
            'user_id' => 1,
            'skill_name' =>  '人類学&民族学',
            'skill_param' =>  'anthropology',
            'skill_value' =>  0,
            'skill_order' =>  0,
        ];
    }
}

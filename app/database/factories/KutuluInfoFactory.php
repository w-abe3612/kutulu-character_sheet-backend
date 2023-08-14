<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KutuluInfoFactory extends Factory
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
            'character_title' =>  'aaa', 
            'injury_value' => 0,
            'ability_value_max' => 0,
            'ability_value_total' => 0,
            'specialized_skill_max' =>  0, 
            'specialized_skill_total' => 0,
            'possession_item' => 'aaa',
            'character_preference' => 'aaa',
        ];
    }
}
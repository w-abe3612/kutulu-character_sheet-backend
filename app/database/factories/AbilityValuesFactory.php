<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbilityValuesFactory extends Factory
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
            'user_id'	        => 1,	
            'skill_name'        => "名声",
            'skill_param'       => "prestige",
            'skill_value'       => 1,
            'skill_type'        => 1,
            'skill_order'       => 1,
        ];
    }
}



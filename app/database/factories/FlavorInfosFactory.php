<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlavorInfosFactory extends Factory
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
            'flavor_info_param' =>  '', 
            'flavor_info_name' => '',
            'flavor_info_value' => '',
            'flavor_info_order' => 0
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterInfosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'player_name'=> $this->faker->realText(rand(10,15)),
            'player_character'=> $this->faker->realText(rand(10,15)),
            'image_path'=>'',
            'image_name'=>'',
        ];
    }
}
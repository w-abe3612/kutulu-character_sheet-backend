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
            'character_title'=> $this->faker->realText(rand(10,15)),
            'injury_value'=>0,
            'image_path'=>'',
            'ability_value_max'=>13,
            'ability_value_total'=>0,
            'specialized_skill_max'=>10,
            'specialized_skill_total'=>0,
            'possession_item'=>$this->faker -> sentence(4,true),
            'character_preference'=>$this->faker -> sentence(4,true),
            'delete_flg'=> false,
            'deleted_at'=> null,
        ];
    }
}
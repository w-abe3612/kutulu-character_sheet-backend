<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\CharacterInfos;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
         // テストユーザ作成


    }
    /**
     * A basic test example.
     *
     * @return void
     */
    /*
    public function test_example()
    {
        $response = $this->get('/api/v1/characters');
        dd($response);
        $response->assertStatus(201);
    }*/

    public function test_example() {
        // こうしてログイン状態を作る
        $this->user = User::factory()->create();
        $this->actingAs($this->user)->get('/');

        $data = [
            'player_name'=> 'test',
            'player_character'=> 'test',
            'character_title'=> 'test',
            'injury_value'=>0,
            'image_path'=>'test',
            'ability_value_max'=>13,
            'ability_value_total'=>0,
            'specialized_skill_max'=>10,
            'specialized_skill_total'=>0,
            'possession_item'=>'ああああああ',
            'character_preference'=>'あああああああ',
            'delete_flg'=> false,
        ];
        $response = $this->get('/api/v1/character/1');
        $response ->assertStatus(201);

        $response = $this->postJson('/api/v1/character/create/', $data);
        $response ->assertStatus(201);
        
    }
}

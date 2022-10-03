<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
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
/*
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
        
    }*/

    public function test_registration() {
        // ユーザー仮作成
        $data = [
            'name' => 'test1234',
            'email' => 'test1234@test.cm',
            'password' => 'test1234', 
            'password_confirmation' => 'test1234'
        ];
        $response = $this->postJson('/api/v1/registration/create/', $data);
        $response ->assertStatus(201);
        // ユーザー認証
        $test_date = '';
        $test_date = RegisterUser::where('email','test1234@test.cm')->get();
        
        $token = $test_date[0]->token;
        $data2 = [
            'name' => 'test1234',
            'email' => 'test1234@test.cm',
            'password' => 'test1234', 
            'password_confirmation' => 'test1234',
            'token' => $token
        ];

        $response2 = $this->postJson('/api/v1/verify/', $data2);
        $response2 ->assertStatus(201);

        
        $verifed_user = '';
        $verifed_user = User::where('email','test1234@test.cm')->get();

        // ログイン
        $data3 = [
            'email' => 'test1234@test.cm',
            'password' => 'test1234',
        ];
        $response3 = $this->postJson('/api/login/', $data3);
        $response3 ->assertStatus(201);

        $response4 = $this->postJson('/api/logout/');
        //$response4 ->assertStatus(201);
    }
}

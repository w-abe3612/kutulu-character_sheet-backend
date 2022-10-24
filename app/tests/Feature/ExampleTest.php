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

    public function test_example() {
        

    }
/*
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
    }*/

    public function create_function() {

    }
}

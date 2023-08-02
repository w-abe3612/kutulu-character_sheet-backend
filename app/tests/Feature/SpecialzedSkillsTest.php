<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\CharacterInfos;
use App\Http\Controllers\AuthController;
use App\Models\SpecialzedSkills;

class SpecialzedSkillsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_specialzed_skills() {

        //$response = $this->getJson('/api/v1/specialzed_skills');
        //dd($response);
        //$response->assertStatus(401);
        //$response->assertJson();
        //$response->dump();
        $user = User::factory()->create();

        $this->actingAs( $user );
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);
        $specialzedSkills = SpecialzedSkills::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id
        ]);

        $response = $this->getJson('/api/v1/specialzed_skills?character_id='.$characterInfos->id);
        $response->assertStatus(200);
        /*
        $response->assertStatus( 200 );
        

        $user = User::factory()->create();
        $this->actingAs( $user );


        $response = $this->getJson('/api/tasks');
        */
    }
/*
    public function VIEWページ用のデータ取得が可能() {

        $data = [
            'title' => ''
        ];

        $response = $this->getJson('/api/tasks',$data);
    }
    */
}
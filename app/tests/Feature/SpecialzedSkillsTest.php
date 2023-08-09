<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\CharacterInfos;
use App\Http\Controllers\AuthController;
use App\Models\SpecialzedSkills;
use App\Services\AuthServices;

class SpecialzedSkillsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_specialzed_skills() {
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
    }

    public function test_get_specialzed_skills_view() {
        $user = User::factory()->create();
        $user->public_page_token = AuthServices::public_pageToken( $user->id );
        $user->save();
        
        $this->actingAs( $user );
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);
        $characterInfos->public_page_token = AuthServices::public_pageToken( $user->id );
        $characterInfos->save();

        $specialzedSkills = SpecialzedSkills::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id
        ]);
        //dd($characterInfos->public_page_token);
        $response = $this->getJson('/api/v1/specialzed_skills/view/?userPageToken='.$user->public_page_token.'&characterPageToken='.$characterInfos->public_page_token);
        
       $response->assertStatus(200);
    }
}
<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\CharacterInfos;
use App\Http\Controllers\AuthController;
use App\Models\AbilityValues;
use App\Services\AuthServices;

class AbilityValuesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_ability_values() {
        $user = User::factory()->create();

        $this->actingAs( $user );
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);

        $abilityValues = AbilityValues::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id,
            'skill_name'        => "名声",
            'skill_param'       => "prestige",
            'skill_value'       => 1,
            'skill_type'        => 1,
            'skill_order'       => 1,
        ]);

        $response = $this->getJson('/api/v1/ability_values/?character_id='.$characterInfos->id);
        
        $response->assertStatus(200);
    }

    public function test_get_ability_values_view() {
        $user = User::factory()->create();
        $user->public_page_token = AuthServices::public_pageToken( $user->id );
        $user->save();

        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);
        $characterInfos->public_page_token = AuthServices::public_pageToken( $user->id );
        $characterInfos->save();

        $abilityValues = AbilityValues::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id,
            'skill_name'        => "名声",
            'skill_param'       => "prestige",
            'skill_value'       => 1,
            'skill_type'        => 1,
            'skill_order'       => 1,
        ]);

        $response = $this->getJson('/api/v1/ability_values/view/?userPageToken='.$user->public_page_token.'&characterPageToken='.$characterInfos->public_page_token);
        
        $response->assertStatus(200);
    }
}
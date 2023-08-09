<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\CharacterInfos;
use App\Http\Controllers\AuthController;
use App\Models\FlavorInfos;
use App\Services\AuthServices;

class FlavorInfosTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_flavor_infos() {
        $user = User::factory()->create();

        $this->actingAs( $user );
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);

        $flavorInfos = FlavorInfos::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id,
            'flavor_info_name' => '職業',
            'flavor_info_param' =>  'weight', 
            'flavor_info_value' => '職業名',
            'flavor_info_order' => 0
        ]);
        
        $response = $this->getJson('/api/v1/flavor_infos?character_id='.$characterInfos->id);
        $response->assertStatus(200);
    }

    public function test_get_flavor_infos_view() {
        $user = User::factory()->create();
        $user->public_page_token = AuthServices::public_pageToken( $user->id );
        $user->save();

        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);
        $characterInfos->public_page_token = AuthServices::public_pageToken( $user->id );
        $characterInfos->save();

        $flavorInfos = FlavorInfos::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id,
            'flavor_info_name' => '職業',
            'flavor_info_param' =>  'weight', 
            'flavor_info_value' => '職業名',
            'flavor_info_order' => 0
        ]);

        $response = $this->getJson('/api/v1/flavor_infos/view?userPageToken='.$user->public_page_token.'&characterPageToken='.$characterInfos->public_page_token.'&user_id='.$user->id);
        
        $response->assertStatus(200);
    }
}
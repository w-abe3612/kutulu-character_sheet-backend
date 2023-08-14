<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RegisterUser;
use App\Models\CharacterInfos;
use App\Http\Controllers\AuthController;
use App\Models\KutuluInfo;
use App\Services\AuthServices;

class KutuluInfoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_kutulu_info() {
        $user = User::factory()->create();

        $this->actingAs( $user );
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);

        $kutuluInfo = KutuluInfo::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id
        ]);

        $response = $this->getJson('/api/v1/kutulu_info/?character_id='.$characterInfos->id);
        $response->assertStatus(200);
    }

    public function test_get_kutulu_info_view() {
        $user = User::factory()->create();
        $user->public_page_token = AuthServices::public_pageToken( $user->id );
        $user->save();
        
        $characterInfos = CharacterInfos::factory()->create([
            'user_id' => $user->id,
        ]);
        $characterInfos->public_page_token = AuthServices::public_pageToken( $user->id );
        $characterInfos->save();

        $kutuluInfo = KutuluInfo::factory()->create([
            'user_id' => $user->id,
            'character_info_id' => $characterInfos->id
        ]);

        $response = $this->getJson('/api/v1/kutulu_info/view/?userPageToken='.$user->public_page_token.'&characterPageToken='.$characterInfos->public_page_token);

        $response->assertStatus(200);
    }
}
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

class AbilityValuesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_ability_values() {
    }

    public function test_get_ability_values_view() {
    }
}
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithUser;

class LoginTest extends TestCase
{

    use RefreshDatabase,
        WithFaker,
        WithUser;


    public function setUp(): void
    {
        parent::setUp();
        $this->setUpUser();
    }

    /**
     * A basic feature test example.
     */
    public function testSuccessIfIsPersonalAccessTokenCorrect(): void
    {

        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);


        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'token',
            ]
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_type' => User::class,
            'tokenable_id' => $this->user->id,
            'token' => PersonalAccessToken::findToken($response->original['data']['token'])?->token
        ]);
    }

    public function testBadRequestIfRequestedDataIsIncorrect()
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->faker->randomAscii,
            'password' => '',
        ]);

        $response->assertBadRequest();
    }
}

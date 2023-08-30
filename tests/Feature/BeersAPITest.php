<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BeersAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create an user and sends a get request to Laravel API Endpoint using JWT and assert if the response is not empty.
     */
    public function test_create_user_and_get_beers_list(): void
    {
        $this->createUser();

        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->token])->get(route('get-beers-list', ["length" => 25, "start" => 0]));
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
    }

    /**
     * Create an user and sends a get request to Laravel API Endpoint using JWT without parameters and assert if the response is empty.
     */
    public function test_create_user_and_get_beers_list_without_parameters(): void
    {
        $this->createUser();

        $response = $this->withHeaders(['Authorization' => "Bearer " . $this->token])->get(route('get-beers-list', ["length" => -1, "start" => 0]));

        $response->assertStatus(422);
        $response->assertJsonStructure(["errors"]);
    }

    /**
     * Sends a get request to Laravel API Endpoint using a wrong token and assert if the response is empty.
     */
    public function test_get_beers_list_with_wrong_token(): void
    {
        $response = Http::withHeaders(['Authorization' => "Bearer errato"])->get(route('get-beers-list', ["length" => 25, "start" => 0]));
        $this->assertTrue($response->status() === 401);
        $this->assertEmpty($response->json());
    }
}

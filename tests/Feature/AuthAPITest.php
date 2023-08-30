<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create an user and sends and logs in
     */
    public function test_create_user_and_login(): void
    {
        $this->createUser();

        $response = $this->post(route('login', ["username" => "utente", "password" => "password"]));
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
    }

    /**
     * Create an user and sends and logs in
     */
    public function test_create_user_and_login_then_logout(): void
    {
        $this->createUser();

        $response = $this->post(route('login', ["username" => "utente", "password" => "password"]));
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());

        $logout_response = $this->withHeaders(['Authorization' => "Bearer ".$this->token])->get(route('logout'));
        $logout_response->assertStatus(200);
        $this->assertNotEmpty($logout_response->json());
    }


    /**
     * Create an user and sends and logs in
     */
    public function test_create_user_and_login_with_wrong_credentials(): void
    {
        $this->createUser();

        $response = $this->post(route('login', ["username" => "utente", "password" => "password errata"]));
        $response->assertStatus(401);
        $response->assertJsonStructure(["message"]);
    }
}

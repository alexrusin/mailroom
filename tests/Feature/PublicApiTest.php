<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_gets_401()
    {
    	$this->withExceptionHandling()
    		->getJson('/api/user')
    		->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_get_user_info()
    {
    	$this->signIn();

    	$user = auth()->user();

    	$apiToken = $user->api_token;

    	$this->withExceptionHandling()
    		->json('get', '/api/user', [], ['Authorization' => 'Bearer ' . $apiToken])
    		->assertStatus(200)
    		->assertJson([
    			'name' => $user->name
    		]);

    }

    /** @test */
    public function missing_api_routes_should_return_a_json_404()
    {
        $response = $this->get('/api/missing/route');

        $response->assertStatus(404);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
           'error' => [
                'code' => 'NOT-FOUND',
                'http_code' => 404,
                'message' => 'Not found'
            ]   
        ]);
    }
}

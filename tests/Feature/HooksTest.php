<?php

namespace Tests\Feature;


use App\Hook;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HooksTest extends TestCase
{
	use RefreshDatabase;
    /** @test */
    public function unregistered_user_cant_create_a_hook()
    {
    	$this->withExceptionHandling()
               ->get(route('root'))
               ->assertRedirect('/login');

        $this->withExceptionHandling()
               ->post(route('hooks.store'))
               ->assertRedirect('/login');

         $this->withExceptionHandling()
            ->get(route('hooks.create'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_route() 
    {
    	$this->signIn();

    	$hook = [
    		'method' => 'get',
    		'path' => 'hello/world',
    	];

    	$this->post(route('hooks.store'), $hook);

    	$this->assertDatabaseHas('hooks', [
    		'user_id' => auth()->id()
    	]);
    }

    /** @test */
    public function it_displays_hooks_only_belonging_to_authenticated_user()
    {
    	$this->signIn();

    	Hook::create([
    		'user_id' => auth()->id(),
    		'path' => 'hi',
    		'method' => 'get'
    	]);

    	Hook::create([
    		'user_id' => auth()->id(),
    		'path' => 'buy',
    		'method' => 'get'
    	]);

    	Hook::create([
    		'user_id' => 99,
    		'path' => 'hello',
    		'method' => 'get'
    	]);

    	$this->assertEquals(2, Hook::all()->count());
    }

    /** @test */
    public function user_can_see_routes()
    {
    	$this->signIn();

    	Hook::create([
    		'user_id' => auth()->id(),
    		'path' => 'hi',
    		'method' => 'get'
    	]);

    	Hook::create([
    		'user_id' => auth()->id(),
    		'path' => 'buy',
    		'method' => 'get'
    	]);

    	$this->get(route('hooks.index'))
    		->assertSee('hi');
    }

    /** @test */
    public function a_user_cant_delete_hook_not_belonging_to_her() 
    {
        $this->signIn();

        $hook = Hook::create([
            'user_id' => 999,
            'path' => 'hi',
            'method' => 'get'
        ]);

        $this->expectException(ModelNotFoundException::class);

        $this->delete(route('hooks.delete', ['hook' => $hook]));
    }

}

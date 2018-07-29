<?php

namespace Tests\Unit;

use App\Hook;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

class HookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
   	public function route_path_and_method_must_be_unique() 
	{
	 	Hook::create([
    		'user_id' => 1,
    		'path' => 'hi',
    		'method' => 'get'
    	]);

    	$this->expectException(QueryException::class);

    	Hook::create([
    		'user_id' => 1,
    		'path' => 'hi',
    		'method' => 'get'
    	]);
	} 

	/** @test */
	public function path_can_be_the_same_but_method_different()
	{
		Hook::create([
    		'user_id' => 1,
    		'path' => 'hi',
    		'method' => 'get'
    	]);

    	Hook::create([
    		'user_id' => 1,
    		'path' => 'hi',
    		'method' => 'post'
    	]);

    	$count = Hook::withoutGlobalScopes()->count();

    	$this->assertEquals(2, $count);
	}
}

<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
	{
		parent::setUp();

		$this->withoutExceptionHandling();
	}

    protected function signIn($user = null)
    {
    	$user = $user ?: $this->create(User::class);

    	$this->actingAs($user);

    	return $this;
    }

    protected function create($class, $attributes = [], $times = null)
	{
		return factory($class, $times)->create($attributes);
	}

	protected function make($class, $attributes = [], $times = null)
	{
		return factory($class, $times)->make($attributes);
	}
}

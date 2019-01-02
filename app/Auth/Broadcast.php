<?php 
namespace App\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;

class Broadcast implements Guard
{
    public function check()
	{	
        $routePrefix = explode('-', request()->channel_name)[1];
        $this->user = User::whereRoutePrefix($routePrefix)->first();

        request()->setUserResolver(function() {
            return $this->user;
        });

        if ($this->user) {
            return true;
        } else {
            return false;
        }

    }

    public function user()
    {
    	return $this->user;
    }

    public function guest() 
    {
        return false;
    }

    public function id() 
    {
        return $this->user->id;
    }

    public function validate(array $credentials = []) 
    {
        return $this->user->route_prefix === $credentials['route_prefix'];
    }

    public function setUser(Authenticatable $user) 
    {
        $this->user = $user;
    }

}
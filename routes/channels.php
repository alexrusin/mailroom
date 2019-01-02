<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('{route_prefix}-{id}', function ($user, $route_prefix, $id) {
    return true;
});

// Route::post('/broadcasting/auth', function($request) {
// 	dd('hello there');
	
// });

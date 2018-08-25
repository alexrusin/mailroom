<?php

use App\Hook;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

try {
	$routes = Hook::withoutGlobalScopes()->select('path', 'method')->get();

	foreach ($routes as $route) {
		$method = $route->method;
		$path = $route->path;
		Route::$method('/'. $path, 'RoutesController@process');
	}
} catch (\Exception $e) {
	
}

Route::get('/hooks', 'HooksApiController@index');
Route::get('/hooks/{id}', 'HooksApiController@show');


Route::fallback(function(){

    return response()->json([
            'error' => [
                'code' => 'NOT-FOUND',
                'http_code' => 404,
                'message' => 'Not found'
            ]
        ], 404);

})->name('api.fallback.404');


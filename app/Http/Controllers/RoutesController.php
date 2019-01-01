<?php

namespace App\Http\Controllers;

use App\Events\HookReceived;
use App\Hook;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
    public function process() 
    { 	
	    $path = ltrim(request()->path(), 'api/');
    	$method = request()->method();

    	$hook = Hook::where('path', $path)
    		->where('method', strtolower($method))
    		->first();
    	if(!$hook) {
    		return response(null, 404);
    	}

    	$url = request()->url();
    	$queryString  = request()->getQueryString();
    	$ip = request()->ip();
   		$headers = $this->getHeaders();
   		$body = request()->getContent();

   		$hook->url = $url;
   		$hook->query_string = $queryString;
   		$hook->ip = $ip;
   		$hook->headers = $headers;
   		$hook->body = $body;

   		$hook->save();

      event(new HookReceived($hook));

   		return response(null, 201);
    }

    protected function getHeaders() 
    {
    	$headers = [];
	    foreach($_SERVER as $key => $value) {
	        if (substr($key, 0, 5) <> 'HTTP_') {
	            continue;
	        }
	        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
	        $headers[$header] = $value;
	    }
	    return $headers;  
    }
}

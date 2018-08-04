<?php

namespace App\Transformers;

use App\Hook;
use League\Fractal\TransformerAbstract;

class HooksTransformer extends TransformerAbstract
{
	
	public function transform(Hook $hook) 
	{
		return [
			'id' => $hook->id,
			'path' => $hook->path,
			'method' => $hook->method,
			'ip' => $hook->ip,
			'url' => $hook->url,
			'query_string' => $hook->query_string,
			'headers' => $hook->headers,
			'body' => $hook->body,
			'created_at' => $hook->created_at->toAtomString(),
			'updated_at' => $hook->updated_at->toAtomString()
		];
	}
}
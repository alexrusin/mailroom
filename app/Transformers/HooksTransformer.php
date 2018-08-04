<?php

namespace App\Transformers;

use App\Hook;
use League\Fractal\TransformerAbstract;

class HooksTransformer extends TransformerAbstract
{
	
	public function transform(Hook $hook) 
	{
		return [
			'path' => $hook->path,
			'url' => $hook->url,
			'query_string' => $hook->query_string
		];
	}
}
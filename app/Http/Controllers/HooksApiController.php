<?php

namespace App\Http\Controllers;

use App\Hook;
use App\Transformers\HooksTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class HooksApiController extends ApiController
{
     public function __construct(Manager $fractal) {
        parent::__construct($fractal);
        $this->middleware('auth:api');
    }

    public function index()
    {
    	$hooks = Hook::paginate(50);

    	return $this->respondWithPagination($hooks, new HooksTransformer);
    }

    public function show($id)
    {
    	$hook = Hook::find($id);
        if(!$hook) {
            return $this->errorNotFound();
        }
       return $this->respondWithItem($hook, new HooksTransformer);
    }
}

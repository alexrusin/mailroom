<?php

namespace App\Http\Controllers;

use App\Hook;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $hooks = Hook::latest()->get();
        return view('hooks.index', compact('hooks'));
    }

    public function create() 
    {
    	return view('hooks.create');
    }

    public function store()
    {
    	request()->validate([
    		'path' => 'required|max:191',
    		'method' => 'required'
    	]);

    	$routeSuffix = trim(request('path'), '/');
    	$route = auth()->user()->route_prefix . '/' .$routeSuffix;

        try {
            Hook::create([
                'user_id' => auth()->id(),
                'path' => $route,
                'method' => request('method')
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('flash', 'Error: rote already exists');
        }
    	
    	

        return redirect(route('hooks.index'))->with('flash', 'Your route has been created');

    }

    public function destroy(Hook $hook) 
    {
        try {
            $hook->delete();
           return redirect()->back()->with('flash', 'Route has been deleted');
        
        } catch (\Exception $e) {
            \Log::error($e);
           return redirect()->back()->with('flash', 'Error: Failed to delete route');
        }
    }
}

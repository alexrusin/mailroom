<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->except(['verifyUser', 'resendVerificationEmail']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function verifyUser() 
    {
        $token = request('token');

        if ($token && auth()->user()->verify_token === $token) {
            auth()->user()->verified = true;
            auth()->user()->save();
        }

        return view('verify-user');
    }

    public function resendVerificationEmail() 
    {
        $verifyToken = str_random(25);

        auth()->user()->verify_token = $verifyToken;
        auth()->user()->save();

        Mail::to(auth()->user())->queue(new VerifyEmail(auth()->user()));

        return response()->json(['message' => 'Success']);
    }
}

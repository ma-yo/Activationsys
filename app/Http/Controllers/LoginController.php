<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index ()
    {
        $message = 'Hello World';
        return view('login.index', ['message' => $message]);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // direct user home page
    public function index()
    {
        $pizza = Pizza::where('publish_status', 1)->get();
        return view('user.home')->with('pizza', $pizza);
    }
}
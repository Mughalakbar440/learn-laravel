<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeconroller extends Controller
{
    public function Welcome(){
    return view("welcome");

    }
}

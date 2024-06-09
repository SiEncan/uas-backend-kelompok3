<?php

namespace App\Http\Controllers;
use App\Models\Discussion;

use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function home(){
        return view('home', ['title' => 'Newest Discussion']);
    }
}
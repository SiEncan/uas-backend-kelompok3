<?php

namespace App\Http\Controllers;
use App\Models\Discussion;

use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function home(){
        $discussions = Discussion::orderBy('created_at', 'desc')->get();

        return view('home', ['title' => 'Newest Discussion', 'discussions' => $discussions]);
    }

    public function viewDiscussion($id){
        $discussion = Discussion::findOrFail($id);
        return view('discussion', ['title' => "Dicussion Room", 'discussion' => $discussion]);
    }
}
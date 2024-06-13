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

    public function createDiscussion(Request $request){
        $validatedData = $request->validate([
            'title' => 'min:1|max:255',
            'content' => 'min:5|max:10000',
            'author_id' => 'required',
            'community_id' => 'required'
        ]);

        Discussion::create($validatedData);

        return redirect("/community/{$request->community_id}")->with('success', 'Discussion Posted!');
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\Discussion;

use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function home(){
        // $discussions = Discussion::orderBy('created_at', 'desc')->get();
        $discussions = Discussion::withCount('comments')->orderBy('created_at', 'desc')->get();
        

        return view('home', ['title' => 'Newest Discussion', 'discussions' => $discussions]);
    }

    public function viewDiscussion($id){
        $discussion = Discussion::findOrFail($id);
        $comments = $discussion->comments()->orderBy('created_at', 'desc')->get();
        return view('discussion', ['title' => $discussion['community']['name'], 'discussion' => $discussion, 'comments' => $comments]);
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

    public function searchDiscussion(Request $request){
        $validatedSearchKey = $request->validate([
            'search_key' => 'required|string|max:255',
        ]);

        $discussions = Discussion::where('title', 'like', '%' . $validatedSearchKey['search_key'] . '%')
                                ->orWhere('content', 'like', '%' . $validatedSearchKey['search_key'] . '%')
                                ->get();

        if ($discussions->isEmpty()) {
            return view('home', [
                'title' => "No discussion found",
                'discussions' => $discussions,
            ]);
        }

        return view('home', ['title' => "Search: {$validatedSearchKey['search_key']}", 'discussions' => $discussions]);
    }

    public function deleteDiscussion(Request $request,$id){
        $discussion = Discussion::findOrFail($id);

        if ($discussion->author_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not the author of this discussion.');
        }

        $discussion->delete();

        return redirect("/community/{$request->community_id}")->with('success', 'Discussion Deleted!');
    }
}
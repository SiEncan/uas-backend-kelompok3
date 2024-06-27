<?php

namespace App\Http\Controllers;
use App\Models\Discussion;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create(Request $request)
    {   
        $validatedData = $request->validate([
            'content' => 'required|max:10000',
            'discussion_id' => 'required',
        ]);

        $validatedData['author_id'] = auth()->id();

        Comment::create($validatedData);

        return redirect()->back();
    }

    public function deleteComment(Request $request,$id){
        $comment = Comment::findOrFail($id);

        if ($comment->author_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not the author of this comment.');
        }

        $comment->delete();

        return redirect("/discussion/{$request->discussion_id}")->with('success', 'Comment Deleted!');
    }
}
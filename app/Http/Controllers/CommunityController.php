<?php

namespace App\Http\Controllers;
use App\Models\Discussion;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function home(){
        $communities = Community::orderBy('created_at', 'desc')->get();
        return view('communities', ['title' => 'Community', 'communities' => $communities]);
    }

    public function createCommunity(Request $request){
        $validatedData = $request->validate([
            'name' => 'min:1|max:255',
            'description' => 'min:5|max:255',
            'creator_id' => 'required'
        ]);

        Community::create($validatedData);

        return redirect('/community')->with('success', 'Community Created!');
    }

    public function viewCommunity($id){
        $community = Community::findOrFail($id);
        $discussions = $community->discussions()->withCount('comments')->orderBy('created_at', 'desc')->get();
        return view('community', ['title' => $community['name'], 'description' => $community['description'], 'community_id' => $id, 'discussions' => $discussions]);
    }
}

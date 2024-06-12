<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function myProfileView(){
        return view('myprofile', ['title' => 'My Profile']);
    }

    public function updateInfo(Request $request) {

        $user = Auth::user();
        $validatedData = $request->validate([
            'username' => 'nullable|min:3|max:255|unique:users|regex:/^\S*$/i',
            'name' => 'nullable|min:5|max:255',
            'gender' => 'nullable|in:Male,Female',
            'email' => 'nullable|email:dns|unique:users',
        ]);

        $filteredData = array_filter($validatedData, function ($value) {
            return !is_null($value);
        });

        $user->update($filteredData);

        return redirect('/myprofile')->with('success', 'Profile Updated!');
    }
}
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

    public function updatePassword(Request $request) {

        $user = Auth::user();
        $validatedData = $request->validate([
            'current_password' => 'min:5|max:255',
            'new_password' => 'min:5|max:255|same:new_confirm_password',
            'new_confirm_password' => 'min:5|max:255'
        ]);

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password does not match your current password.']);
        }

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Password updated successfully. Please log in again.');
    }
}
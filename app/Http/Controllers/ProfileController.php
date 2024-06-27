<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function myProfileView(){
        return view('myprofile', ['title' => 'My Profile']);
    }

    public function profileView($id){
        $user = User::withCount('discussions')->findOrFail($id);
        return view('profile', ['title' => 'Profile', 'user' => $user]);
    }
    
    public function updateInfo(Request $request) {

        $user = Auth::user();
        $validatedData = $request->validate([
            'username' => 'nullable|min:3|max:255|unique:users|regex:/^\S*$/i',
            'name' => 'nullable|min:5|max:255',
            'gender' => 'nullable|in:Male,Female',
            'email' => 'nullable|email:dns|unique:users',
            'profile_picture' => 'image|file'
        ]);

        if($request->file('profile_picture')) {
            if ($request->current_profile_picture) {
                Storage::delete($request->current_profile_picture);
            }
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
        }

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

    public function deleteProfile(Request $request,$id){
        $user = User::findOrFail($id);

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect('/login')->with('success', 'Your account has been deleted.');
    }
}
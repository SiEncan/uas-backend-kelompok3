<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'username' => 'min:3|max:255|unique:users|regex:/^\S*$/i',
            'name' => 'min:5|max:255',
            'gender' => 'in:Male,Female',
            'email' => 'email:dns|unique:users',
            'password' => 'min:5|max:255|same:confirm_password',
            'confirm_password' => 'min:5|max:255'
        ]);

        unset($validatedData['confirm_password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success', 'Registration Successfull!');
        return redirect('/login')->with('success', 'Registration Successfull!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\PastPaperController;
use App\Models\PastPaper;
class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function register_view() {
        return view('auth.register');
    }

    public function login(Request $request) {
        // Validate Data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('login')->withErrors('Login details are not correct');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('register')->withErrors('Registration error');
    }

    public function home() {
        $pastPapers = PastPaper::latest()->get();
        return view('home', compact('pastPapers'));
    }
    

    public function logout() {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}

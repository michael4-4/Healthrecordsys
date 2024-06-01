<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;



class APIController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|in:MHO,Nurse,Midwife',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'position' => $request->position,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function login(Request $request)
    {
        Log::info('Login method called', ['email' => $request->email]);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 401);
        }

        $user = Auth::user();

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Logged out successfully']);
    }
}

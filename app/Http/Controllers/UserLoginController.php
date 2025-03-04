<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // for authentication
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Add this line
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('UserLogin');
    }

    public function login(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to find the user by email
    $user = User::where('email', $request->email)->first();

    // Check if user exists
    if (!$user) {
        // Return a specific response for email not found
        return response()->json(['success' => false, 'message' => 'Email not found.'], 404);
    }

    // Check if user exists and if password matches
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 401);
    }

    // Attempt to authenticate the user
    if (Auth::guard('users')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // Authentication successful
        return response()->json(['success' => true]);
    }

    // If authentication fails for some reason
    return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again later.'], 500);
    
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}

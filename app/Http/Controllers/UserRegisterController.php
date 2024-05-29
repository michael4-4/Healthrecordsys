<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|in:MHO,Nurse,Midwife', // Ensure role is superadmin
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        // Create a new Admin instance with the validated data
        $users = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'position' => $request->position,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);

        // Optionally, you can log the user in after registration
        // Log the user in after registration
        //Auth::login($admin);

        // Redirect the user to the login page after successful registration
        //return redirect('/dashboard');
    }

    public function showRegistrationForm()
    {
        return view('UserRegister');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Query the database to check if the email already exists
        $users = User::where('email', $email)->first();

        // Return a JSON response indicating whether the email exists or not
        return response()->json(['exists' => $users !== null]);
    }
}
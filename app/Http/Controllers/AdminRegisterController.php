<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminRegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required|in:Admin', // Ensure role is superadmin
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        // Create a new Admin instance with the validated data
        $admins = Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'role' => $request->role,
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
        return view('AdminRegister');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Query the database to check if the email already exists
        $admins = Admin::where('email', $email)->first();

        // Return a JSON response indicating whether the email exists or not
        return response()->json(['exists' => $admins !== null]);
    }
}
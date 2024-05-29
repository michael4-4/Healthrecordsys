<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserProfileController extends Controller
{
     // Show the profile form
     public function showProfileForm()
{
    // Get the current authenticated user
    $user = Auth::guard('users')->user();

    // Fetch distinct roles from the users table
    $positions = User::distinct()->pluck('position')->toArray();

    // Pass the user data and roles to the view
    return view('UserProfile', compact('user', 'positions'));
}

public function updateProfile(Request $request)
{
    // Get the authenticated user
    $user = Auth::guard('users')->user();

    // Validate the incoming request data
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'position' => 'required|in:MHO,Nurse,Midwife',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore($user->id), // Ignore the user's current email
        ],
    ]);

    // Update only the fields that are provided in the request
    $user->fill($validatedData)->save();

    // Optionally, you can return a response indicating success
    return response()->json(['message' => 'Profile updated successfully'], 200);
}


    public function checkEmail(Request $request)
{
    // Retrieve the email from the request
    $email = $request->input('emaill');

    // Check if the email is unique
    $unique = !User::where('email', $email)->exists();

    // Return the result as JSON
    return response()->json(['unique' => $unique]);
}


public function updatePassword(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'currentPassword' => 'required|string|min:8',
        'newPassword' => 'required|string|min:8|different:currentPassword',
        'confirmPassword' => 'required|string|min:8|same:newPassword',
    ]);

    // Get the authenticated user user
    $user = Auth::guard('users')->user();

    
    // Check if the current password matches the one in the database
    if (!Hash::check($validatedData['currentPassword'], $user->password)) {
        // Return error response if current password doesn't match
        return response()->json(['message' => 'Current password is incorrect'], 400);
    }

    // Update the user's password
    $user->password = Hash::make($validatedData['newPassword']);
    $user->save();

    // Return success response
    return response()->json(['message' => 'Password updated successfully'], 200);
}

/**
     * Upload a new profile photo for the authenticated user user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPhoto(Request $request)
    {
        // Create the profile_pictures directory if it doesn't exist
        Storage::disk('public')->makeDirectory('profile_pictures');

        // Check if there's an authenticated user user
        $user = Auth::guard('users')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,jfif,gif,svg' //max:2048', Maximum file size of 2MB
        ]);

        // Delete previous profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');

            // Update profile_picture column for the authenticated user
            $user->profile_picture = $filePath;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No file selected.'], 400);
    }

    public function deletePhoto()
{
    $user = Auth::guard('users')->user();

    if ($user->profile_picture) {
        // Delete the profile picture from storage
        Storage::disk('public')->delete($user->profile_picture);

        // Clear the profile_picture column in the database
        $user->profile_picture = null;
        $user->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'No profile photo to delete.'], 400);
}
}
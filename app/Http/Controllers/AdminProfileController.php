<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // Assuming your admin model is named Admin
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AdminProfileController extends Controller
{
     // Show the profile form
     public function showProfileForm()
{
    // Get the current authenticated admin
    $admin = Auth::guard('admins')->user();

    // Fetch distinct roles from the admins table
    $roles = Admin::distinct()->pluck('role')->toArray();

    // Pass the admin data and roles to the view
    return view('AdminProfile', compact('admin', 'roles'));
}

public function updateProfile(Request $request)
{
    // Get the authenticated admin
    $admin = Auth::guard('admins')->user();

    // Validate the incoming request data
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'role' => 'required|in:Admin', // Ensure role is superadmin
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('admins', 'email')->ignore($admin->id), // Ignore the admin's current email
        ],
    ]);

    // Update only the fields that are provided in the request
    $admin->fill($validatedData)->save();

    // Optionally, you can return a response indicating success
    return response()->json(['message' => 'Profile updated successfully'], 200);
}


    public function checkEmail(Request $request)
{
    // Retrieve the email from the request
    $email = $request->input('emaill');

    // Check if the email is unique
    $unique = !Admin::where('email', $email)->exists();

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

    // Get the authenticated admin user
    $admin = Auth::guard('admins')->user();

    
    // Check if the current password matches the one in the database
    if (!Hash::check($validatedData['currentPassword'], $admin->password)) {
        // Return error response if current password doesn't match
        return response()->json(['message' => 'Current password is incorrect'], 400);
    }

    // Update the admin's password
    $admin->password = Hash::make($validatedData['newPassword']);
    $admin->save();

    // Return success response
    return response()->json(['message' => 'Password updated successfully'], 200);
}

/**
     * Upload a new profile photo for the authenticated admin user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPhoto(Request $request)
    {
        // Create the profile_pictures directory if it doesn't exist
        Storage::disk('public')->makeDirectory('profile_pictures');

        // Check if there's an authenticated admin user
        $admin = Auth::guard('admins')->user();
        if (!$admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,jfif,gif,svg' //max:2048', Maximum file size of 2MB
        ]);

        // Delete previous profile picture if exists
        if ($admin->profile_picture) {
            Storage::disk('public')->delete($admin->profile_picture);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');

            // Update profile_picture column for the authenticated admin
            $admin->profile_picture = $filePath;
            $admin->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No file selected.'], 400);
    }

    public function deletePhoto()
{
    $admin = Auth::guard('admins')->user();

    if ($admin->profile_picture) {
        // Delete the profile picture from storage
        Storage::disk('public')->delete($admin->profile_picture);

        // Clear the profile_picture column in the database
        $admin->profile_picture = null;
        $admin->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'No profile photo to delete.'], 400);
}
}
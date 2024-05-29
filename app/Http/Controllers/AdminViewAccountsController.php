<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class AdminViewAccountsController extends Controller
{
    public function showViewAccountsForm($id)
    {
        // Find the user by ID
    $user = User::findOrFail($id);

    // Pass the user data to the view
    return view('AdminViewAccounts', compact('user'));
    }
    
}

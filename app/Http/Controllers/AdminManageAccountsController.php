<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;

class AdminManageAccountsController extends Controller
{
    public function showManageAccountsForm(Request $request)
    {
        // Fetch all users from the database
        $users = User::all();

        // Retrieve all positions
        $positions = ['Show','MHO', 'Nurse', 'Midwife'];

        // Initialize query builder
        $query = User::query();

        // Check if search query is provided
        if ($request->has('search_query')) {
            $searchQuery = $request->search_query;
            // Apply search filter to multiple columns as needed
            $query->where(function ($q) use ($searchQuery) {
                $q->where('lastname', 'like', '%' . $searchQuery . '%')
                ->orWhere('firstname', 'like', '%' . $searchQuery . '%')
                ->orWhere('position', 'like', '%' . $searchQuery . '%');
            });
        }

        // Check if filter by position is applied
        if ($request->has('filter') && in_array($request->filter, $positions)) {
            // Convert both column value and selected position value to lowercase for case-insensitive comparison
            $query->whereRaw('LOWER(position) LIKE ?', ['%' . strtolower($request->filter) . '%']);
        }

        // Paginate the filtered records with 25 records per page
        $users = $query->paginate(25);

        // Handle page parameter for navigation
        if ($request->has('page')) {
            Paginator::currentPageResolver(function () use ($request) {
                return $request->page;
            });
        }

        // Calculate the starting number for the current page
        $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
        
        // Pass the users data to the view
        return view('AdminManageAccounts', compact('users', 'startNumber', 'positions'));
    }

    public function deleteAccount($id)
{
    try {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Return success response
        return response()->json(['message' => 'User deleted successfully.'], 200);
    } catch (\Exception $e) {
        // Return error response
        return response()->json(['message' => 'Failed to delete user.'], 500);
    }
}

}

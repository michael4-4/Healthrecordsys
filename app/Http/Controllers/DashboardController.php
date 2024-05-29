<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PatientEnrolmentRecord;
use Carbon\Carbon;
use App\Models\PatientTreatmentRecord;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /*
    public function showDashboard()
    {
        return view('Dashboard');
    } */

    public function showDashboard()
{
    // Get the current authenticated user
    $user = Auth::guard('users')->user();

    // Fetch distinct roles from the users table
    $positions = User::distinct()->pluck('position')->toArray();

    return view('Dashboard', compact('user', 'positions'));
    
}
}
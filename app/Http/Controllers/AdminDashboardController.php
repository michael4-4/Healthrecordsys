<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\PatientEnrolmentRecord;
use Carbon\Carbon;
use App\Models\PatientTreatmentRecord;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /*
    public function showDashboard()
    {
        return view('Dashboard');
    } */

    public function showDashboard()
{
    // Get the current authenticated user
    $admin = Auth::guard('admins')->user();

    // Fetch distinct roles from the users table
    $roles = Admin::distinct()->pluck('role')->toArray();

    return view('AdminDashboard', compact('admin', 'roles'));
}
    
}

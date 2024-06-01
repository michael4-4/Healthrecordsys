<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEnrolmentRecord; // Make sure to import the PatientEnrolmentRecord model
use Illuminate\Validation\Rule;

class AddPatientRecordController extends Controller
{
    
    // Method to show the form for adding a record
    public function showAddPatientRecordForm()
    {
        return view('AddPatientRecord');
    }

    // Method to handle the form submission and save the record
    public function store(Request $request)
    {

    try {
        // Your existing code to validate and save the data
        // Validate the form data
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'sex' => 'required|in:Male,Female',
            'civil_status' => 'required|in:Single,Married,Annulled,Widow,Separated,Cohab',
            'maiden_name' => 'nullable|string|max:255',
            'mother_name' => 'required|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'blood_type' => 'nullable|string|max:10',
            'contact_number' => 'nullable|string|max:15',
            'educational_attainment' => 'nullable|in:Elementary,High School,College,Vocational,Post Graduate,No Formal Education',
            'employment_status' => 'nullable|in:Student,Employed,Unemployed,Retired,Unknown',
            'family_member' => 'nullable|in:Father,Mother,Son,Daughter',
            'barangay' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'dswd_nhts' => 'nullable|in:Yes,No',
            'facility_house_number' => 'nullable|string|max:255',
            'fourps_member' => 'nullable|in:Yes,No',
            'household_number' => 'nullable|string|max:255',
            'philhealth_member' => 'nullable|in:Yes,No',
            'status_type' => 'nullable|in:Member,Dependent',
            'philhealth_number' => 'nullable|string|max:255',
            'member_category' => 'nullable|string|max:255',
            'primary_care_benefit' => 'nullable|in:Yes,No',
        ]);

        // Create a new patient enrolment record instance
        $patientEnrolmentRecord = new PatientEnrolmentRecord($validatedData);

        // Save the patient enrolment record to the database
        $saved = $patientEnrolmentRecord->save();

        return response()->json(['message' => 'Patient enrolement record saved successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return response()->json(['error' => 'Failed to save the record or data'], 500);
        }
    }
}
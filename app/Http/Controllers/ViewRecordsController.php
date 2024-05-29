<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEnrolmentRecord; // Make sure to import the PatientEnrolmentRecord model
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;
use App\Models\PatientTreatmentRecord;

class ViewRecordsController extends Controller
{
    // Method to show the form for viewing records
    public function showViewRecordsForm(Request $request)
    {
        
        // Retrieve all barangays
        $barangays = ['Show','Acnam', 'Barikir', 'Barangobong', 'Bugayong', 'Caray', 'Cabitauran', 'Garnaden', 'Naguilian', 'Poblacion', 'Sto. Nino', 'Uguis'];

        // Initialize query builder
        $query = PatientEnrolmentRecord::query();

        // Check if search query is provided
        if ($request->has('search_query')) {
            $searchQuery = $request->search_query;
            // Apply search filter to multiple columns as needed
            $query->where(function ($q) use ($searchQuery) {
                $q->where('last_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('first_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('barangay', 'like', '%' . $searchQuery . '%');
            });
        }

        // Check if filter by barangay is applied
        if ($request->has('filter') && in_array($request->filter, $barangays)) {
            // Convert both column value and selected barangay value to lowercase for case-insensitive comparison
            $query->whereRaw('LOWER(barangay) LIKE ?', ['%' . strtolower($request->filter) . '%']);
        }

        // Paginate the filtered records with 25 records per page
        $patients = $query->paginate(100);

        // Handle page parameter for navigation
        if ($request->has('page')) {
            Paginator::currentPageResolver(function () use ($request) {
                return $request->page;
            });
        }

        // Calculate the starting number for the current page
        $startNumber = ($patients->currentPage() - 1) * $patients->perPage() + 1;

        return view('ViewRecords', compact('patients', 'startNumber', 'barangays'));
    }

    // Method to view an individual patient record
    public function view($id)
    {
        try {
            // Retrieve patient details
            $patient = PatientEnrolmentRecord::findOrFail($id);

            // Paginate treatment records associated with the patient
            $treatmentRecords = PatientTreatmentRecord::where('patient_id', $id)
                                ->select('treatment_id', 'patient_id', 'date_of_consultation', 'mode_of_transaction', 'type_of_consultation')
                                ->paginate(25); // Paginate with 25 records per page

            // Pass both patient and paginated treatment records to the view
            return view('ViewPatientInfo', compact('patient', 'treatmentRecords'));
        } catch (ModelNotFoundException $e) {
            // Handle case where patient with given ID is not found
            return redirect()->route('ViewRecords')->with('error', 'Patient record not found.');
        }
    }

    // Method to edit an individual patient record
    public function edit($id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        return view('EditPatientInfo', compact('patient'));
    }
    
    // Method to update an individual patient record
    public function update(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        // Add validation rules here for each field
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

    // Find the patient by ID
    $patient = PatientEnrolmentRecord::findOrFail($id);

    // Update the patient record with the validated data
    $patient->update($validatedData);

    // Redirect back to the view with a success message
    return redirect()->back()->with('success', 'Patient information updated successfully');
    // Redirect back to the patient details page or any other appropriate route
    //return redirect()->route('patient.update', ['id' => $patient->id])->with('success', 'Patient information updated successfully.');
    
}

}
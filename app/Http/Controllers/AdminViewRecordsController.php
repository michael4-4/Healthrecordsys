<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEnrolmentRecord; // Make sure to import the PatientEnrolmentRecord model
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;
use App\Models\PatientTreatmentRecord;

class AdminViewRecordsController extends Controller
{
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

    return view('AdminViewRecords', compact('patients', 'startNumber', 'barangays'));
}

public function deleteRecord($id)
    {
        try {
            // Find the patient enrollment record by ID
            $record = PatientEnrolmentRecord::findOrFail($id);

            // Delete the record
            $record->delete();

            // Return success response
            return response()->json(['message' => 'Record deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['message' => 'Failed to delete record.'], 500);
        }
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
             return view('AdminViewPatientInfo', compact('patient', 'treatmentRecords'));
         } catch (ModelNotFoundException $e) {
             // Handle case where patient with given ID is not found
             return redirect()->route('AdminViewRecords')->with('error', 'Patient record not found.');
         }
     }

}

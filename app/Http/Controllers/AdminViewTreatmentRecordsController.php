<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PatientEnrolmentRecord;
use App\Models\PatientTreatmentRecord;

class AdminViewTreatmentRecordsController extends Controller
{
    public function view($id, $treatment_id)
    
    {

        $patient = PatientEnrolmentRecord::findOrFail($id);
        // Retrieve the treatment record based on the provided treatment_id
        $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

        // Paginate treatment records associated with the patient
        $treatmentRecords = PatientTreatmentRecord::where('patient_id', $id)
        ->select('treatment_id', 'patient_id', 'date_of_consultation', 'mode_of_transaction', 'type_of_consultation');
        // Pass the treatment record to the view
        return view('AdminViewTreatmentRecords', compact('patient', 'treatmentRecord', 'treatmentRecords'));
    }

    public function deleteTreatmentRecord($id, $treatment_id)
    {
        try {
            // Find the treatment record
            $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

            // Check if the treatment record belongs to the specified patient
            if ($treatmentRecord->patient_id != $id) {
                return response()->json(['error' => 'Treatment record not found for this patient.'], 404);
            }

            // Delete the treatment record
            $treatmentRecord->delete();

            // Return success response
            return response()->json(['message' => 'Treatment record deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Return error response if treatment record is not found
            return response()->json(['error' => 'Failed to delete treatment record.'], 500);
        }
    }
}

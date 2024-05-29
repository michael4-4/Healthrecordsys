<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PatientTreatmentRecord; // Make sure to import the PatientTreatmentRecord model
use App\Models\PatientEnrolmentRecord;

class AddPatientTreatmentController extends Controller
{
    // Method to show the form for adding a record
    public function showAddPatientTreatmentForm($id)
    {
        // Assuming you have logic to fetch the $patient object
        $patient = PatientEnrolmentRecord::findOrFail($id); // Replace $patientId with the actual patient ID
        return view('AddPatientTreatment', compact('patient'));
    }

    public function store(Request $request)
    {
        try {
        
            // Validate the request data
            $validatedData = $request->validate([
                'patient_id' => 'required|exists:patient_enrolment_records,patient_id',
                'age' => 'required|string|max:255', 
                'religion' => 'required|string|max:255',
                'date_of_consultation' => 'required|date',
                'consultation_time' => 'required|date_format:H:i',
                'mode_of_transaction' => 'required|in:Walk-in,Visited,Referral',
                'blood_pressure' => 'nullable|string|max:255',
                'temperature' => 'nullable|string|max:255',
                'height' => 'nullable|string|max:255',
                'weight' => 'nullable|string|max:255',
                'allergies' => 'nullable|string|max:255',
                'covid_vaccine' => 'nullable|in:Vaccinated,Unvaccinated',
                'nature_of_visit' => 'nullable|in:New Consultation/Case,New Admission,Follow-up Visit',
                'type_of_consultation' => 'required|in:General,Prenatal,Child Care,Child Immunization,Sick Children,Child Nutrition,Injury,Adult Immunization,Family Planning,Postpartum,Tuberculosis,Firecracker Injury,Dental Care',
                'attending_provider' => 'nullable|string|max:255', 
                'diagnosis' => 'nullable|string|max:255', 
                'medication' => 'nullable|string|max:255', 
                'laboratory_findings' => 'nullable|string|max:255', 
                'performed_laboratory_test' => 'nullable|string|max:255', 
                'healthcare_provider' => 'nullable|string|max:255', 
                'referred_from' => 'nullable|string|max:255', 
                'referred_to' => 'nullable|string|max:255', 
                'reason_for_referral' => 'nullable|string|max:255', 
                'chief_complaints' => 'nullable|string|max:255', 
                'referred_by' => 'nullable|string|max:255', 
            ]);

            // Create a new patient treatment record
            $patientTreatmentRecord = new PatientTreatmentRecord($validatedData);

            // Save the patient treatment record
            $saved = $patientTreatmentRecord->save();
            
                return response()->json(['message' => 'Patient treatment record saved successfully'], 200);
            } catch (\Exception $e) {
                // Handle any exceptions or errors
                return response()->json(['error' => 'Failed to save the treatment record or data'], 500);
            }
        }

}

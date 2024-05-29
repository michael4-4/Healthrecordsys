<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PatientEnrolmentRecord;
use App\Models\PatientTreatmentRecord;
use Illuminate\Pagination\Paginator;

class ViewTreatmentRecordsController extends Controller
{
    public function view($id, $treatment_id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        // Retrieve the treatment record based on the provided treatment_id
        $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

        // Pass the treatment record to the view
        return view('ViewTreatmentRecords', compact('patient', 'treatmentRecord'));
    }

    public function edit($id, $treatment_id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

        return view('EditTreatmentRecord', compact('patient', 'treatmentRecord'));
    }

    public function updateTreatment(Request $request, $id)
{
    try {
    // Validate the form data
    $validatedData = $request->validate([
        'treatment_id' => 'required|exists:patient_treatment_records,treatment_id',
        'patient_id' => 'required|exists:patient_enrolment_records,patient_id',
        'age' => 'required|string|max:255', 
        'religion' => 'required|string|max:255',
        'date_of_consultation' => 'required|date',
        'consultation_time' => 'required', 'regex:/^\d{2}:\d{2}$/',
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

    // Find the patient and treatment record based on IDs
    $patient = PatientEnrolmentRecord::findOrFail($id);
    $treatmentRecord = PatientTreatmentRecord::findOrFail($request->input('treatment_id'));

    // Include patient ID in the validated data
    $validatedData['patient_id'] = $patient->patient_id;

    // Update the treatment record with the validated data
    $treatmentRecord->update($validatedData);

    // Redirect back to the view with a success message
    return redirect()->back()->with('success', 'Patient Treatment Record updated successfully');
} catch (\Exception $e) {
    // Log the error for debugging
    \Log::error('Error updating treatment record: '.$e->getMessage());
    // Redirect back with an error message
    return redirect()->back()->with('error', 'Failed to update treatment record. Please try again later.');

        }
    }
}
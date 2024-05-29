<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEnrolmentRecord;
use App\Models\PatientTreatmentRecord;

class EditTreatmentRecordsController extends Controller
{
    public function edit($id, $treatment_id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);

        return view('EditTreatmentRecord', compact('patient', 'treatmentRecord'));
    }

    public function update(Request $request, $id, $treatment_id)
{
    $request->validate([
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

    $patient = PatientEnrolmentRecord::findOrFail($id);
    $treatmentRecord = PatientTreatmentRecord::findOrFail($treatment_id);
    // Update treatment record fields based on the submitted data
    $treatmentRecord->update($request->all());

    return response()->json(['message' => 'Treatment record updated successfully.']);
}

}
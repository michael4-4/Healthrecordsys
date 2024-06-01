<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEnrolmentRecord;
use App\Models\PatientTreatmentRecord;
use Inertia\Inertia;

class Patients extends Controller
{
    public function index(Request $request)
    {
        $barangays = ['Show', 'Acnam', 'Barikir', 'Barangobong', 'Bugayong', 'Caray', 'Cabitauran', 'Garnaden', 'Naguilian', 'Poblacion', 'Sto. Nino', 'Uguis'];

        $query = PatientEnrolmentRecord::query();

        if ($request->has('search_query')) {
            $searchQuery = $request->search_query;
            $query->where(function ($q) use ($searchQuery) {
                $q->where('last_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('first_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('barangay', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($request->has('filter') && in_array($request->filter, $barangays)) {
            $query->whereRaw('LOWER(barangay) LIKE ?', ['%' . strtolower($request->filter) . '%']);
        }

        $patients = $query->paginate(100);
        $startNumber = ($patients->currentPage() - 1) * $patients->perPage() + 1;
        return Inertia::render('patients/index', [
            'patients' => $patients,
            'startNumber' => $startNumber,
            'barangays' => $barangays,
        ]);
    }

    public function getAdd()
    {
        return Inertia::render('patients/add');
    }

    public function postAdd(Request $request)
    {
        try {
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

            $patientEnrolmentRecord = new PatientEnrolmentRecord($validatedData);

            $saved = $patientEnrolmentRecord->save();

            return response()->json(['message' => 'Patient enrolement record saved successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return response()->json(['error' => 'Failed to save the record or data'], 500);
        }
    }

    public function getEdit($id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        return Inertia::render('patients/edit', [
            'patient' => $patient,
        ]);
    }

    public function getView($id)
    {
        $patient = PatientEnrolmentRecord::findOrFail($id);
        $treatmentRecords = PatientTreatmentRecord::where('patient_id', $id)
            ->select('treatment_id', 'patient_id', 'date_of_consultation', 'mode_of_transaction', 'type_of_consultation')
            ->paginate(25);

        return Inertia::render('patients/view', [
            'patient' => $patient,
            'treatmentRecords' => $treatmentRecords,
        ]);
    }


    public function postEdit(Request $request, $id)
    {
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
        $patient = PatientEnrolmentRecord::findOrFail($id);
        $patient->update($validatedData);
        return redirect()->back()->with('success', 'Patient information updated successfully');
    }
}

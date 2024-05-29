<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PatientEnrolmentRecord extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'patient_id';

    protected $table = 'patient_enrolment_records';

    // Add any additional model logic here
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'sex',
        'civil_status',
        'maiden_name',
        'mother_name',
        'spouse_name',
        'date_of_birth',
        'blood_type',
        'contact_number',
        'educational_attainment',
        'employment_status',
        'family_member',
        'barangay',
        'municipality',
        'province',
        'dswd_nhts',
        'facility_house_number',
        'fourps_member',
        'household_number',
        'philhealth_member',
        'status_type',
        'philhealth_number',
        'member_category',
        'primary_care_benefit',
    ];

    // Define the relationship to PatientTreatmentRecord model
    public function treatmentRecords()
    {
        return $this->hasMany(PatientTreatmentRecord::class, 'patient_id', 'id');
    }
}
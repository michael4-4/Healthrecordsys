<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PatientTreatmentRecord extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $primaryKey = 'treatment_id';

     protected $table = 'patient_treatment_records';

     protected $fillable = [
        'treatment_id', // Include treatment_id in the fillable attributes
        'patient_id',
        'age',
        'religion',
        'date_of_consultation',
        'consultation_time',
        'mode_of_transaction',
        'blood_pressure',
        'temperature',
        'height',
        'weight',
        'allergies',
        'covid_vaccine',
        'nature_of_visit',
        'type_of_consultation',
        'attending_provider',
        'diagnosis',
        'medication',
        'laboratory_findings',
        'performed_laboratory_test',
        'healthcare_provider',
        'referred_from',
        'referred_to',
        'reason_for_referral',
        'chief_complaints',
        'referred_by',
    ];

    /**
     * Get the patient associated with the treatment record.
     */

     // Define the relationship to PatientEnrolmentRecord model
    public function patient()
    {
        return $this->belongsTo(PatientEnrolmentRecord::class, 'patient_id');
    }
}
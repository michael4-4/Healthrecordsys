<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientTreatmentRecordSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate patient_id values from 42 to 11928
        $patientIdRangeStart = 13;
        $patientIdRangeEnd = 11968;
        $patientIds = range($patientIdRangeStart, $patientIdRangeEnd);

        foreach ($patientIds as $patientId) {
            $treatment_id = DB::table('patient_treatment_records')->max('treatment_id') + 1;

            // Generate other treatment record data here
            $age = $faker->numberBetween(1, 100);
            $religion = $faker->randomElement(['Catholic', 'Iglesia', 'Aglipayano', 'Islam']);
            $date_of_consultation = $faker->dateTimeBetween('2018-01-01', 'now')->format('Y-m-d');
            $consultation_time = $faker->time('H:i');
            $mode_of_transaction = $faker->randomElement(['Walk-in', 'Visited', 'Referral']);
            $blood_pressure = $faker->numberBetween(90, 180) . '/' . $faker->numberBetween(60, 120); // nullable
            $temperature = $faker->randomFloat(35, 40); // nullable
            $height = $faker->numberBetween(100, 250); // nullable
            $weight = $faker->numberBetween(30, 200); // nullable
            $allergies = $faker->sentence(); // nullable
            $covid_vaccine = $faker->randomElement(['Vaccinated', 'Unvaccinated']); // nullable
            $nature_of_visit = $faker->randomElement(['New Consultation/Case', 'New Admission', 'Follow-up Visit']); // nullable
            $type_of_consultation = $faker->randomElement(['General', 'Prenatal', 'Child Care', 'Child Immunization', 'Sick Children', 'Child Nutrition', 'Injury', 'Adult Immunization', 'Family Planning', 'Postpartum', 'Tuberculosis', 'Firecracker Injury', 'Dental Care']);
            $attending_provider = $faker->name; // nullable
            $diagnosis = $faker->randomElement(['Arthritis', 'Asthma', 'Cancer', 'Diabetes', 'Hypertension', 'Obesity']);
            $medication = $faker->sentence(); // nullable
            $laboratory_findings = $faker->sentence(); // nullable
            $performed_laboratory_test = $faker->sentence(); // nullable
            $healthcare_provider = $faker->company; // nullable
            $referred_from = $faker->company; // nullable
            $referred_to = $faker->company; // nullable
            $reason_for_referral = $faker->sentence(); // nullable
            $chief_complaints = $faker->sentence(); // nullable
            $referred_by = $faker->name; // nullable
            $createdAt = $faker->dateTimeBetween('2018-01-01', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            DB::table('patient_treatment_records')->insert([
                'treatment_id' => $treatment_id,
                'patient_id' => $patientId,
                'age' => $age,
                'religion' => $religion,
                'date_of_consultation' => $date_of_consultation,
                'consultation_time' => $consultation_time,
                'mode_of_transaction' => $mode_of_transaction,
                'blood_pressure' => $blood_pressure,
                'temperature' => $temperature,
                'height' => $height,
                'weight' => $weight,
                'allergies' => $allergies,
                'covid_vaccine' => $covid_vaccine,
                'nature_of_visit' => $nature_of_visit,
                'type_of_consultation' => $type_of_consultation,
                'attending_provider' => $attending_provider,
                'diagnosis' => $diagnosis,
                'medication' => $medication,
                'laboratory_findings' => $laboratory_findings,
                'performed_laboratory_test' => $performed_laboratory_test,
                'healthcare_provider' => $healthcare_provider,
                'referred_from' => $referred_from,
                'referred_to' => $referred_to,
                'reason_for_referral' => $reason_for_referral,
                'chief_complaints' => $chief_complaints,
                'referred_by' => $referred_by,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}

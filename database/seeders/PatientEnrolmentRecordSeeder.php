<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientEnrolmentRecordSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $barangays = [
            'Brgy. 1 Poblacion',
            'Brgy. 2 Barikir',
            'Brgy. 3 Caray',
            'Brgy. 4 Cabitauran',
            'Brgy. 5 Sto. Nino',
            'Brgy. 6 Naguilian',
            'Brgy. 7 Garnaden',
            'Brgy. 8 Bugayong',
            'Brgy. 9 Uguis',
            'Brgy. 10 Barangobong',
            'Brgy. 11 Acnam'
        ];

        for ($i = 0; $i < 11928; $i++) {
            $createdAt = $faker->dateTimeBetween('2018-01-01', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');
            $last_name = $faker->lastName;
            $first_name = $faker->firstName;
            $middle_name = $faker->firstName; // Assuming you want a first name as middle name
            $suffix = $faker->suffix; // nullable
            $sex = $faker->randomElement(['Male', 'Female']);
            $civil_status = $faker->randomElement(['Single', 'Married', 'Annulled', 'Widow', 'Separated', 'Cohab']);
            $maiden_name = $faker->lastName; // nullable
            $mother_name = $faker->name;
            $spouse_name = $faker->name; // nullable
            $date_of_birth = $faker->date();
            $blood_type = $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']); // nullable
            $contact_number = $faker->phoneNumber; // nullable
            $educational_attainment = $faker->randomElement(['Elementary', 'High School', 'College', 'Vocational', 'Post Graduate', 'No Formal Education']); // nullable
            $employment_status = $faker->randomElement(['Student', 'Employed', 'Unemployed', 'Retired', 'Unknown']); // nullable
            $family_member = $faker->randomElement(['Father', 'Mother', 'Son', 'Daughter']); // nullable
            $barangay = $faker->randomElement($barangays);
            $municipality = $faker->city;
            $province = $faker->state;
            $dswd_nhts = $faker->randomElement(['Yes', 'No']); // nullable
            $facility_house_number = $faker->buildingNumber; // nullable
            $fourps_member = $faker->randomElement(['Yes', 'No']); // nullable
            $household_number = $faker->buildingNumber; // nullable
            $philhealth_member = $faker->randomElement(['Yes', 'No']); // nullable
            $status_type = $faker->randomElement(['Member', 'Dependent']); // nullable
            $philhealth_number = $faker->ean13; // nullable
            $member_category = $faker->word; // nullable
            $primary_care_benefit = $faker->randomElement(['Yes', 'No']); // nullable

            DB::table('patient_enrolment_records')->insert([
                'last_name' => $last_name,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'suffix' => $suffix,
                'sex' => $sex,
                'civil_status' => $civil_status,
                'maiden_name' => $maiden_name,
                'mother_name' => $mother_name,
                'spouse_name' => $spouse_name,
                'date_of_birth' => $date_of_birth,
                'blood_type' => $blood_type,
                'contact_number' => $contact_number,
                'educational_attainment' => $educational_attainment,
                'employment_status' => $employment_status,
                'family_member' => $family_member,
                'barangay' => $barangay,
                'municipality' => $municipality,
                'province' => $province,
                'dswd_nhts' => $dswd_nhts,
                'facility_house_number' => $facility_house_number,
                'fourps_member' => $fourps_member,
                'household_number' => $household_number,
                'philhealth_member' => $philhealth_member,
                'status_type' => $status_type,
                'philhealth_number' => $philhealth_number,
                'member_category' => $member_category,
                'primary_care_benefit' => $primary_care_benefit,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}

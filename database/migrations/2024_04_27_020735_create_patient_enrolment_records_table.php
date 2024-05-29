<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patient_enrolment_records', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('suffix')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->enum('civil_status', ['Single', 'Married', 'Annulled', 'Widow', 'Separated', 'Cohab']);
            $table->string('maiden_name')->nullable();
            $table->string('mother_name');
            $table->string('spouse_name')->nullable();
            $table->date('date_of_birth');
            $table->string('blood_type')->nullable();
            $table->string('contact_number')->nullable();
            $table->enum('educational_attainment', ['Elementary', 'High School', 'College', 'Vocational', 'Post Graduate', 'No Formal Education'])->nullable();
            $table->enum('employment_status', ['Student', 'Employed', 'Unemployed', 'Retired', 'Unknown'])->nullable();
            $table->enum('family_member', ['Father', 'Mother', 'Son', 'Daughter'])->nullable();
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->enum('dswd_nhts', ['Yes', 'No'])->nullable();
            $table->string('facility_house_number')->nullable();
            $table->enum('fourps_member', ['Yes', 'No'])->nullable();
            $table->string('household_number')->nullable();
            $table->enum('philhealth_member', ['Yes', 'No'])->nullable();
            $table->enum('status_type', ['Member', 'Dependent'])->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('member_category')->nullable();
            $table->enum('primary_care_benefit', ['Yes', 'No'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_enrolment_records');
    }
};

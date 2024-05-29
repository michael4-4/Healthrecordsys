<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_treatment_records', function (Blueprint $table) {
            $table->id('treatment_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('patient_enrolment_records')->onDelete('cascade'); // Ensure foreign key constraint and cascade deletion
            $table->string('age');
            $table->string('religion');
            $table->date('date_of_consultation');
            $table->time('consultation_time');
            $table->enum('mode_of_transaction', ['Walk-in', 'Visited', 'Referral']);
            $table->string('blood_pressure')->nullable();
            $table->string('temperature')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('allergies')->nullable();
            $table->enum('covid_vaccine', ['Vaccinated', 'Unvaccinated'])->nullable();
            $table->enum('nature_of_visit', ['New Consultation/Case', 'New Admission', 'Follow-up Visit'])->nullable();
            $table->enum('type_of_consultation', ['General', 'Prenatal', 'Child Care', 'Child Immunization', 'Sick Children', 'Child Nutrition', 'Injury', 'Adult Immunization', 'Family Planning', 'Postpartum', 'Tuberculosis', 'Firecracker Injury', 'Dental Care']);
            $table->string('attending_provider')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('medication')->nullable();
            $table->text('laboratory_findings')->nullable();
            $table->string('performed_laboratory_test')->nullable();
            $table->string('healthcare_provider')->nullable();
            $table->string('referred_from')->nullable();
            $table->string('referred_to')->nullable();
            $table->text('reason_for_referral')->nullable();
            $table->text('chief_complaints')->nullable();
            $table->string('referred_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_treatment_records');
    }
};

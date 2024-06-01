<script>
    import { onMount } from 'svelte';
    import Layout from '../Layout.svelte';
    // Props passed from Laravel
    export let patient;
    export let treatmentRecords;

    let isPDF = false;

    onMount(() => {
        isPDF = window.location.pathname.includes('download-pdf');
    });
</script>

<Layout>
    <main class="main-content">
        <div class="container2">
            <div class="form-patient">
                <div class="details-personal">
                    <div class="patient-info-title">
                        <span class="title3">PATIENT INFORMATION</span>
                    </div>
                    {#if !isPDF}
                        <a href={`/patient/edit/${patient.patient_id}`} class="edit-link"><i class='bx bx-pencil'></i> Edit</a>
                    {/if}
                    <div class="fields">
                        <div class="input-field1">
                            <label for="full_name">Name: </label>
                            <input type="text" id="full_name" name="full_name" value={patient.first_name + ' ' + patient.last_name} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="sex">Sex: </label>
                            <input type="text" id="sex" name="sex" value={patient.sex} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="civil_status">Civil Status: </label>
                            <input type="text" id="civil_status" name="civil_status" value={patient.civil_status} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="maiden_name">Maiden Name (married women):</label>
                            <input type="text" id="maiden_name" name="maiden_name" value={patient.maiden_name} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="mother_name">Mother's Name:</label>
                            <input type="text" id="mother_name" name="mother_name" value={patient.mother_name} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="spouse_name">Spouse's Name:</label>
                            <input type="text" id="spouse_name" name="spouse_name" value={patient.spouse_name} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="date_of_birth">Date of Birth:</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value={patient.date_of_birth} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="blood_type">Blood Type:</label>
                            <input type="text" id="blood_type" name="blood_type" value={patient.blood_type} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" id="contact_number" name="contact_number" value={patient.contact_number} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="educational_attainment">Educational Attainment:</label>
                            <input type="text" id="educational_attainment" name="educational_attainment" value={patient.educational_attainment} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="employment_status">Employment Status:</label>
                            <input type="text" id="employment_status" name="employment_status" value={patient.employment_status} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="family_member">Family Member:</label>
                            <input type="text" id="family_member" name="family_member" value={patient.family_member} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value={patient.barangay} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="dswd_nhts">DSWD NHTS:</label>
                            <input type="text" id="dswd_nhts" name="dswd_nhts" value={patient.dswd_nhts} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="facility_house_number">Facility House No.:</label>
                            <input type="text" id="facility_house_number" name="facility_house_number" value={patient.facility_house_number} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="fourps_member">4ps Member:</label>
                            <input type="text" id="fourps_member" name="fourps_member" value={patient.fourps_member} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="household_number">Household No.:</label>
                            <input type="text" id="household_number" name="household_number" value={patient.household_number} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="philhealth_number">Philhealth Member:</label>
                            <input type="text" id="philhealth_number" name="philhealth_number" value={patient.philhealth_member} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="status_type">Status Type:</label>
                            <input type="text" id="status_type" name="status_type" value={patient.status_type} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="philhealth_number">Philhealth No.:</label>
                            <input type="text" id="philhealth_number" name="philhealth_number" value={patient.philhealth_number} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="member_category">Category (if member):</label>
                            <input type="text" id="member_category" name="member_category" value={patient.member_category} readonly>
                        </div>
                        <div class="input-field1">
                            <label for="primary_care_benefit">Primary Care Benefit (PCB):</label>
                            <input type="text" id="primary_care_benefit" name="primary_care_benefit" value={patient.primary_care_benefit} readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container3">
            <span class="title3">TREATMENT RECORD</span>
            {#if !isPDF}
                <a href={`/AddPatientTreatment/${patient.patient_id}`} class="add-button"><i class='bx bx-plus'></i>Add</a>
            {/if}
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 5%">Number</th>
                        <th style="width: 5%">Date</th>
                        <th style="width: 8%">Mode of Transaction</th>
                        <th style="width: 8%">Type of Consultation</th>
                        {#if !isPDF}
                        <th style="width: 5%">Action</th>
                        {/if}
                    </tr>
                </thead>
                <tbody>
                    {#if treatmentRecords.data.length > 0}
                        {#each treatmentRecords.data as treatment_record, index}
                            <tr>
                                <td>{index + 1}</td>
                                <td>{treatment_record.date_of_consultation}</td>
                                <td>{treatment_record.mode_of_transaction}</td>
                                <td>{treatment_record.type_of_consultation}</td>
                                {#if !isPDF}
                                <td>
                                    <a href={`/treatment/view/${patient.patient_id}/${treatment_record.treatment_id}`} class="view-button" title="View"><i class="fas fa-eye"></i></a>
                                    <a href={`/treatment/edit/${patient.patient_id}/${treatment_record.treatment_id}`} class="edit-button" title="Edit"><i class="fas fa-edit"></i></a>
                                </td>
                                {/if}
                            </tr>
                        {/each}
                    {:else}
                        <tr>
                            <td colspan="5" style="text-align:center; font-style: oblique;">No treatment records found</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
            {#if !isPDF}
            <div class="pagination" style="display: flex; justify-content: flex-end; margin-top: 20px;">
                <div class="page-number" style="margin-left: 10px; font-size: 15px; font-weight: medium; margin-right: auto; padding: 10px 20px 10px;">
                    Page {treatmentRecords.current_page} of {treatmentRecords.last_page}
                </div>
                {#if treatmentRecords.prev_page_url}
                    <a href={treatmentRecords.prev_page_url} class="pagination-link">&laquo; Previous</a>
                {:else}
                    <span class="pagination-link disabled">&laquo; Previous</span>
                {/if}
                {#if treatmentRecords.next_page_url}
                    <a href={treatmentRecords.next_page_url} class="pagination-link">Next &raquo;</a>
                {:else}
                    <span class="pagination-link disabled">Next &raquo;</span>
                {/if}
            </div>
            {/if}
        </div>
    </main>
    
    <style>
        /* Add your CSS styles here */
    </style>
    
</Layout>
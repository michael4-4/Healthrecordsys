<!-- PatientForm.svelte -->
<script>
    import { onMount } from 'svelte';
    import Layout from '../Layout.svelte';
    let formValues = {};
    
    async function submitForm(){

    }

    onMount(() => {
        // Initialize form values or any required setup
    });

    const handleSubmit = (event) => {
        event.preventDefault();
        submitForm();
    };
</script>

<Layout>
    
<main>
    <div class="container">
        <form on:submit={handleSubmit}>
            <div class="form first">
                <div class="details personal">
                    <span class="title">PATIENT INFORMATION</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" bind:value={formValues.last_name} required>
                        </div>
                        <div class="input-field">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" bind:value={formValues.first_name} required>
                        </div>
                        <div class="input-field">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" bind:value={formValues.middle_name} required>
                        </div>
                        <div class="input-field">
                            <label for="suffix">Suffix</label>
                            <input type="text" id="suffix" bind:value={formValues.suffix} placeholder="Ex. Jr., Sr., II, III">
                        </div>
                        <div class="input-field">
                            <input type="radio" name="sex" value="Male" bind:group={formValues.sex} id="dot-1-1">
                            <input type="radio" name="sex" value="Female" bind:group={formValues.sex} id="dot-2-1">
                            <span class="title">Sex</span>
                            <div class="category">
                                <label for="dot-1-1">
                                    <span class="dot one"></span>
                                    <span class="sex">Male</span>
                                </label>
                                <label for="dot-2-1">
                                    <span class="dot two"></span>
                                    <span class="sex">Female</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field">
                            <label for="civil_status">Civil Status</label>
                            <select id="civil_status" bind:value={formValues.civil_status} required>
                                <option disabled selected>Select civil status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Annulled">Annulled</option>
                                <option value="Widow">Widow/er</option>
                                <option value="Separated">Separated</option>
                                <option value="Cohab">Co-Habitation</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="maiden_name">Maiden Name for Married Women</label>
                            <input type="text" id="maiden_name" bind:value={formValues.maiden_name}>
                        </div>
                        <div class="input-field">
                            <label for="mother_name">Mother's Name</label>
                            <input type="text" id="mother_name" bind:value={formValues.mother_name} required>
                        </div>
                        <div class="input-field">
                            <label for="spouse_name">Spouse's Name</label>
                            <input type="text" id="spouse_name" bind:value={formValues.spouse_name}>
                        </div>
                        <div class="input-field">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" id="date_of_birth" bind:value={formValues.date_of_birth} required>
                        </div>
                        <div class="input-field">
                            <label for="blood_type">Blood Type</label>
                            <input type="text" id="blood_type" bind:value={formValues.blood_type}>
                        </div>
                        <div class="input-field">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" id="contact_number" bind:value={formValues.contact_number} placeholder="09xxxxxxxxx">
                        </div>
                        <div class="input-field">
                            <label for="educational_attainment">Educational Attainment</label>
                            <select id="educational_attainment" bind:value={formValues.educational_attainment} required>
                                <option disabled selected>Select</option>
                                <option value="Elementary">Elementary</option>
                                <option value="High School">High School</option>
                                <option value="College">College</option>
                                <option value="Vocational">Vocational</option>
                                <option value="Post Graduate">Post Graduate</option>
                                <option value="No Formal Education">No Formal Education</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="employment_status">Employment Status</label>
                            <select id="employment_status" bind:value={formValues.employment_status} required>
                                <option disabled selected>Select</option>
                                <option value="Student">Student</option>
                                <option value="Employed">Employed</option>
                                <option value="Unemployed">Unemployed/None</option>
                                <option value="Retired">Retired</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="family_member">Family Member <small>(Family Position)</small></label>
                            <select id="family_member" bind:value={formValues.family_member} required>
                                <option disabled selected>Select</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                            </select>
                        </div>
                    </div>

                    <span class="info">Residential Address</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="barangay">Barangay</label>
                            <input type="text" id="barangay" bind:value={formValues.barangay} required>
                        </div>
                        <div class="input-field">
                            <label for="municipality">Municipality</label>
                            <input type="text" id="municipality" bind:value={formValues.municipality} required>
                        </div>
                        <div class="input-field">
                            <label for="province">Province</label>
                            <input type="text" id="province" bind:value={formValues.province} required>
                        </div>
                    </div>
                    <hr>
                    <span class="title2">ADDITIONAL INFORMATION</span>
                    <div class="fields">
                        <div class="input-field column">
                            <input type="radio" name="dswd_nhts" value="Yes" bind:group={formValues.dswd_nhts} id="dot-1-2">
                            <input type="radio" name="dswd_nhts" value="No" bind:group={formValues.dswd_nhts} id="dot-2-2">
                            <span class="title">DSWD NHTS</span>
                            <div class="category">
                                <label for="dot-1-2">
                                    <span class="dot one"></span>
                                    <span class="dswd_nhts">Yes</span>
                                </label>
                                <label for="dot-2-2">
                                    <span class="dot two"></span>
                                    <span class="dswd_nhts">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field column">
                            <label for="facility_house_number">Facility House No.</label>
                            <input type="text" id="facility_house_number" bind:value={formValues.facility_house_number}>
                        </div>
                        <div class="input-field column">
                            <input type="radio" name="fourps_member" value="Yes" bind:group={formValues.fourps_member} id="dot-1-3">
                            <input type="radio" name="fourps_member" value="No" bind:group={formValues.fourps_member} id="dot-2-3">
                            <span class="title">4ps Member</span>
                            <div class="category">
                                <label for="dot-1-3">
                                    <span class="dot one"></span>
                                    <span class="fourps_member">Yes</span>
                                </label>
                                <label for="dot-2-3">
                                    <span class="dot two"></span>
                                    <span class="fourps_member">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field column">
                            <label for="household_number">Household No.</label>
                            <input type="text" id="household_number" bind:value={formValues.household_number}>
                        </div>
                        <div class="input-field column">
                            <input type="radio" name="philhealth_member" value="Yes" bind:group={formValues.philhealth_member} id="dot-1-4">
                            <input type="radio" name="philhealth_member" value="No" bind:group={formValues.philhealth_member} id="dot-2-4">
                            <span class="title">Philhealth Member</span>
                            <div class="category">
                                <label for="dot-1-4">
                                    <span class="dot one"></span>
                                    <span class="philhealth_member">Yes</span>
                                </label>
                                <label for="dot-2-4">
                                    <span class="dot two"></span>
                                    <span class="philhealth_member">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field column">
                            <label for="status_type">Status Type</label>
                            <select id="status_type" bind:value={formValues.status_type}>
                                <option disabled selected>Select</option>
                                <option value="Member">Member</option>
                                <option value="Dependent">Dependent</option>
                            </select>
                        </div>
                        <div class="input-field column">
                            <label for="philhealth_number">Philhealth No.</label>
                            <input type="text" id="philhealth_number" bind:value={formValues.philhealth_number}>
                        </div>
                        <div class="input-field column">
                            <label for="member_category">If Member, Please Indicate Category</label>
                            <input type="text" id="member_category" bind:value={formValues.member_category}>
                        </div>
                        <div class="input-field column">
                            <input type="radio" name="primary_care_benefit" value="Yes" bind:group={formValues.primary_care_benefit} id="dot-1-5">
                            <input type="radio" name="primary_care_benefit" value="No" bind:group={formValues.primary_care_benefit} id="dot-2-5">
                            <span class="title">Primary Care Benefit (PCB)</span>
                            <div class="category">
                                <label for="dot-1-5">
                                    <span class="dot one"></span>
                                    <span class="primary_care_benefit">Yes</span>
                                </label>
                                <label for="dot-2-5">
                                    <span class="dot two"></span>
                                    <span class="primary_care_benefit">No</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="button">
                    <button class="submit" type="submit">
                        <span class="btnsave">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>
</main>

</Layout>
<style>
    /* Add your styles here */
</style>

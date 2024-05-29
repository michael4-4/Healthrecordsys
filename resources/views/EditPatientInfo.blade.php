<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Information</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/EditPatientInfo.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
    <a href="#" class="brand2"><img src="{{asset('images/logoend.png')}}" alt="logo"></a>
    <ul class="side-menu">
        <li><a href="{{route('Dashboard')}}"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
        <li><a href="{{route ('AddPatientRecord')}}"> &nbsp;&emsp;<i class="bi bi-plus-circle-fill"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;Add Record</a></li>
        <li><a href="{{route ('ViewRecords')}}" class="active"> &nbsp;&emsp;<i class="bi bi-search"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;View Records</a></li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu toggle-sidebar'></i>
        <span class="divider"></span>
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/pencil.png" alt="pencil"/>&ensp;&nbsp;EDIT PATIENT INFORMATION</div>
        <div class="profile">
           
            <i class="fas fa-chevron-down arrow hover-pointer"></i>
            <ul class="profile-link">
					<li><a href="{{ route ('UserProfile') }}"><i class='bx bx-user-circle icon'></i> Profile</a></li>
					<li><a id="logout-btn" onclick="logout()" style="cursor: pointer;"><i class='bx bx-log-out icon'></i> Logout</a></li>
			</ul>
        </div>
    </nav>
    <!-- NAVBAR -->

      <!-- BREADCRUMBS -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('ViewRecords') }}" class="dark-grey">View Records</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('patient.view', ['id' => $patient->patient_id])}}" class="dark-grey">Patient Information</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
        <span class="breadcrumb-separator">&ensp;</span>Edit Information</li>
    </ol>



    <!-- Back Button -->
    <div class="button-container">
        <a href="{{ route('patient.view', ['id' => $patient->patient_id])}}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <!--"{{ url()->previous() }}"-->
<!-- MAIN -->
<main class="main-content">
	<div class="container">
    <form id="updateForm" action="{{ route('patient.update', ['id' => $patient->patient_id]) }}" method="post">
    @csrf
    @method('POST')
    <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
            <div class="form first">
                <div class="details personal">
                    <span class="title">PATIENT INFORMATION</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $patient->last_name }}" required>
                        </div>
                        <div class="input-field">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ $patient->first_name }}" required>
                        </div>
                        <div class="input-field">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" value="{{ $patient->middle_name }}" required>
                        </div>
                        <div class="input-field">
                            <label for="suffix">Suffix</label>
                            <input type="text" id="suffix" name="suffix" value="{{ $patient->suffix }}" placeholder="Ex. Jr., Sr., II, III">
                        </div>
                        <div class="input-field">
                                <input type="radio" name="sex" value="Male" id="dot-1-1" {{ $patient->sex === 'Male' ? 'checked' : '' }}>
                                <input type="radio" name="sex" value="Female" id="dot-2-1" {{ $patient->sex === 'Female' ? 'checked' : '' }}>
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
                            <select id="civil_status" name="civil_status" required>
                                <option disabled>Select civil status</option>
                                <option value="Single" {{ $patient->civil_status === 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ $patient->civil_status === 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Annulled" {{ $patient->civil_status === 'Annulled' ? 'selected' : '' }}>Annulled</option>
                                <option value="Widow" {{ $patient->civil_status === 'Widow' ? 'selected' : '' }}>Widow/er</option>
                                <option value="Separated" {{ $patient->civil_status === 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Cohab" {{ $patient->civil_status === 'Cohab' ? 'selected' : '' }}>Co-Habitation</option>
                            </select>
                        </div>                        
                        <div class="input-field">
                            <label for="maiden_name">Maiden Name for Married Women</label>
                            <input type="text" id="maiden_name" name="maiden_name" value="{{ $patient->maiden_name }}">
                        </div>
                        <div class="input-field">
                            <label for="mother_name">Mother's Name</label>
                            <input type="text" id="mother_name" name="mother_name" value="{{ $patient->mother_name }}" required>
                        </div>
                        <div class="input-field">
                            <label for="spouse_name">Spouse's Name</label>
                            <input type="text" id="spouse_name" name="spouse_name" value="{{ $patient->spouse_name }}">
                        </div>                                        
                        <div class="input-field">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $patient->date_of_birth }}" required>
                        </div>
                        <div class="input-field">
                            <label for="blood_type">Blood Type</label>
                            <input type="text" id="blood_type" name="blood_type" value="{{ $patient->blood_type }}">
                        </div>
                        <div class="input-field">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" id="contact_number" name="contact_number" value="{{ $patient->contact_number }}" placeholder="09xxxxxxxxx">
                        </div>
                        <div class="input-field">
                            <label for="educational_attainment">Educational Attainment</label>
                            <select id="educational_attainment" name="educational_attainment" required>
                                <option disabled>Select</option>
                                <option value="Elementary" {{ $patient->educational_attainment === 'Elementary' ? 'selected' : '' }}>Elementary</option>
                                <option value="High School" {{ $patient->educational_attainment === 'High School' ? 'selected' : '' }}>High School</option>
                                <option value="College" {{ $patient->educational_attainment === 'College' ? 'selected' : '' }}>College</option>
                                <option value="Vocational" {{ $patient->educational_attainment === 'Vocational' ? 'selected' : '' }}>Vocational</option>
                                <option value="Post Graduate" {{ $patient->educational_attainment === 'Post Graduate' ? 'selected' : '' }}>Post Graduate</option>
                                <option value="No Formal Education" {{ $patient->educational_attainment === 'No Formal Educational' ? 'selected' : '' }}>No Formal Education</option>
                            </select>
                        </div>                        
                        <div class="input-field">
                            <label for="employment_status">Employment Status</label>
                            <select id="employment_status" name="employment_status" required>
                                <option disabled>Select</option>
                                <option value="Student" {{ $patient->employment_status === 'Student' ? 'selected' : '' }}>Student</option>
                                <option value="Employed" {{ $patient->employment_status === 'Employed' ? 'selected' : '' }}>Employed</option>
                                <option value="Unemployed" {{ $patient->employment_status === 'Unemployed' ? 'selected' : '' }}>Unemployed/None</option>
                                <option value="Retired" {{ $patient->employment_status === 'Retired' ? 'selected' : '' }}>Retired</option>
                                <option value="Unknown" {{ $patient->employment_status === 'Unknown' ? 'selected' : '' }}>Unknown</option>
                            </select>
                        </div>                        
                        <div class="input-field">
                            <label for="family_member">Family Member <small>(Family Position)</small></label>
                            <select id="family_member" name="family_member" required>
                                <option disabled>Select</option>
                                <option value="Father" {{ $patient->family_member === 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Mother" {{ $patient->family_member === 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Son" {{ $patient->family_member === 'Son' ? 'selected' : '' }}>Son</option>
                                <option value="Daughter" {{ $patient->family_member === 'Daughter' ? 'selected' : '' }}>Daughter</option>
                            </select>
                        </div>                        
                        </div>

                        <span class="info">Residential Address</span>
                        <div class="fields">
                            <div class="input-field"> 
                                <label for="barangay">Barangay</label>
                                <input type="text" id="barangay" name="barangay" value="{{ $patient->barangay }}" required>
                            </div>
                            <div class="input-field"> 
                                <label for="municipality">Municipality</label>
                                <input type="text" id="municipality" name="municipality" value="{{ $patient->municipality }}" required>
                            </div>
                            <div class="input-field"> 
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" value="{{ $patient->province }}" required>
                            </div>
                        </div>
                        <hr>
                        <span class="title2">ADDITIONAL INFORMATION</span>
                        <div class="fields">
                            <div class="input-field column">
                                <input type="radio" name="dswd_nhts" value="Yes" id="dot-1-2" {{ $patient->dswd_nhts === 'Yes' ? 'checked' : '' }}>
                                <input type="radio" name="dswd_nhts" value="No" id="dot-2-2" {{ $patient->dswd_nhts === 'No' ? 'checked' : '' }}>
                                <span class="title">DSWD NHTS</span>
                                <div class="category">
                                    <label for="dot-1-2">
                                        <span class="dot one"></span>
                                        <span class="dswd">Yes</span>
                                    </label>
                                    <label for="dot-2-2">
                                        <span class="dot two"></span>
                                        <span class="dswd">No</span>
                                    </label>
                                </div>
                            </div>                         
                            <div class="input-field column">
                                <label for="facility_house_number">Facility House No.</label>
                                <input type="text" id="facility_house_number" name="facility_house_number" value="{{ $patient->facility_house_number }}">
                            </div>
                            <div class="input-field column">
                                <input type="radio" name="fourps_member" value="Yes" id="dot-1-3" {{ $patient->fourps_member === 'Yes' ? 'checked' : '' }}>
                                <input type="radio" name="fourps_member" value="No" id="dot-2-3" {{ $patient->fourps_member === 'No' ? 'checked' : '' }}>
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
                                <input type="text" id="household_number" name="household_number" value="{{ $patient->household_number }}">
                            </div>
                            <div class="input-field column">
                                <input type="radio" name="philhealth_member" value="Yes" id="dot-1-4" {{ $patient->philhealth_member === 'Yes' ? 'checked' : '' }}>
                                <input type="radio" name="philhealth_member" value="No" id="dot-2-4" {{ $patient->philhealth_member === 'No' ? 'checked' : '' }}>
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
                                <select id="status_type" name="status_type">
                                    <option disabled>Select</option>
                                    <option value="Member" {{ $patient->status_type === 'Member' ? 'selected' : '' }}>Member</option>
                                    <option value="Dependent" {{ $patient->status_type === 'Dependent' ? 'selected' : '' }}>Dependent</option>
                                </select>
                            </div>                        
                            <div class="input-field column">
                                <label for="philhealth_number">Philhealth No.</label>
                                <input type="text" id="philhealth_number" name="philhealth_number" value="{{ $patient->philhealth_number }}">
                            </div>
                            <div class="input-field column">
                                <label for="member_category">If Member, Please Indicate Category</label>
                                <input type="text" id="member_category" name="member_category" value="{{ $patient->member_category }}">
                            </div>
                            <div class="input-field column">
                                <input type="radio" name="primary_care_benefit" value="Yes" id="dot-1-5" {{ $patient->primary_care_benefit === 'Yes' ? 'checked' : '' }}>
                                <input type="radio" name="primary_care_benefit" value="No" id="dot-2-5" {{ $patient->primary_care_benefit === 'No' ? 'checked' : '' }}>
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
                    <button class="submit">
                        <span class="btnsave">Update</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
        
            </div>
        </form>
    </div>
</main>
   

</section>
<!-- NAVBAR -->

<script src="{{ asset ('script2.js')}}"></script>

<script>
function logout() {
        // Display SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will be logged out!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!'
        }).then((result) => {
            // If user confirms, proceed with logout
            if (result.isConfirmed) {
                // Create a form element
                const form = document.createElement('form');
                // Set the form attributes
                form.method = 'POST';
                form.action = "{{ route('logout') }}";
                // Create a CSRF token input field
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = "{{ csrf_token() }}";
                // Append the CSRF token input field to the form
                form.appendChild(csrfToken);
                // Append the form to the document body
                document.body.appendChild(form);
                // Submit the form
                form.submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    const form = document.getElementById('updateForm');

    // Get the original form data
    const originalFormData = new FormData(form);

    // Add event listener for form submission
    form.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Display confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to update the patient information.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Serialize form data
                const formData = new FormData(form);

                // Check if the form data has changed
                let formDataChanged = false;
                for (const [key, value] of formData.entries()) {
                    if (value !== originalFormData.get(key)) {
                        formDataChanged = true;
                        break;
                    }
                }

                // If form data has not changed, show a SweetAlert and return
                if (!formDataChanged) {
                    Swal.fire({
                        title: 'No Changes Detected',
                        text: 'Make sure to make changes to the patient information.',
                        icon: 'info'
                    });
                    return;
                }

                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Define the request type, URL, and asynchronous setting
                xhr.open('POST', form.getAttribute('action'), true);

                // Set up the onload function to handle the response
                xhr.onload = function() {
                    // Check if the request was successful
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Display success message using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Patient information updated successfully.',
                            icon: 'success'
                        }).then(() => {
                            // Redirect to another page
                            window.location.href = '{{ route('patient.edit', ['id' => $patient->patient_id]) }}';
                        });
                    } else {
                        // Display error message using SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update patient information.',
                            icon: 'error'
                        });
                    }
                };

                // Send the request with form data
                xhr.send(formData);
            }
        });
    });
});

</script>

</body>
</html>

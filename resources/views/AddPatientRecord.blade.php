<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient Record</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/AddPatientRecord.css')}}">
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
            <li><a href="{{route ('AddPatientRecord')}}" class="active"> &nbsp;&emsp;<i class="bi bi-plus-circle-fill"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;Add Record</a></li>
            <li><a href="{{route ('ViewRecords')}}"> &nbsp;&emsp;<i class="bi bi-search"></i> &nbsp;&nbsp;&nbsp;&nbsp;&ensp;View Records</a></li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <span class="divider"></span>
            <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/plus--v1.png" alt="plus--v1" />&ensp;&nbsp;ADD PATIENT ENROLMENT RECORD</div>
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
            <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>
            <li class="active blue-green">
                <span class="breadcrumb-separator">&ensp;</span>Add Record
            </li>
        </ol>


        <!-- MAIN -->`
        <main>
            <div class="container">
                <form action="{{ route('patient-enrolment.store') }}" method="POST">
                    @csrf
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">PATIENT INFORMATION</span>
                            <div class="fields">
                                <div class="input-field">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                                <div class="input-field">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="input-field">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" required>
                                </div>
                                <div class="input-field">
                                    <label for="suffix">Suffix</label>
                                    <input type="text" id="suffix" name="suffix" placeholder="Ex. Jr., Sr., II, III">
                                </div>
                                <div class="input-field">
                                    <input type="radio" name="sex" value="Male" id="dot-1-1">
                                    <input type="radio" name="sex" value="Female" id="dot-2-1">
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
                                    <input type="text" id="maiden_name" name="maiden_name">
                                </div>
                                <div class="input-field">
                                    <label for="mother_name">Mother's Name</label>
                                    <input type="text" id="mother_name" name="mother_name" required>
                                </div>
                                <div class="input-field">
                                    <label for="spouse_name">Spouse's Name</label>
                                    <input type="text" id="spouse_name" name="spouse_name">
                                </div>
                                <div class="input-field">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                                </div>
                                <div class="input-field">
                                    <label for="blood_type">Blood Type</label>
                                    <input type="text" id="blood_type" name="blood_type">
                                </div>
                                <div class="input-field">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" id="contact_number" name="contact_number" placeholder="09xxxxxxxxx">
                                </div>
                                <div class="input-field">
                                    <label for="educational_attainment">Educational Attainment</label>
                                    <select id="educational_attainment" name="educational_attainment" required>
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
                                    <select id="employment_status" name="employment_status" required>
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
                                    <select id="family_member" name="family_member" required>
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
                                    <input type="text" id="barangay" name="barangay" required>
                                </div>
                                <div class="input-field">
                                    <label for="municipality">Municipality</label>
                                    <input type="text" id="municipality" name="municipality" required>
                                </div>
                                <div class="input-field">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" name="province" required>
                                </div>
                            </div>
                            <hr>
                            <span class="title2">ADDITIONAL INFORMATION</span>
                            <div class="fields">
                                <div class="input-field column">
                                    <input type="radio" name="dswd_nhts" value="Yes" id="dot-1-2">
                                    <input type="radio" name="dswd_nhts" value="No" id="dot-2-2">
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
                                    <input type="text" id="facno" name="facility_house_number">
                                </div>
                                <div class="input-field column">
                                    <input type="radio" name="fourps_member" value="Yes" id="dot-1-3">
                                    <input type="radio" name="fourps_member" value="No" id="dot-2-3">
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
                                    <input type="text" id="household_number" name="household_number">
                                </div>
                                <div class="input-field column">
                                    <input type="radio" name="philhealth_member" value="Yes" id="dot-1-4">
                                    <input type="radio" name="philhealth_member" value="No" id="dot-2-4">
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
                                    <label for="status_type">Status Type </label>
                                    <select id="status_type" name="status_type">
                                        <option disabled selected>Select</option>
                                        <option value="Member">Member</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div class="input-field column">
                                    <label for="philhealth_number">Philhealth No.</label>
                                    <input type="text" id="philheath_number" name="philhealth_number">
                                </div>
                                <div class="input-field column">
                                    <label for="member_category">If Member, Please Indicate Category</label>
                                    <input type="text" id="member_category" name="member_category">
                                </div>
                                <div class="input-field column">
                                    <input type="radio" name="primary_care_benefit" value="Yes" id="dot-1-5">
                                    <input type="radio" name="primary_care_benefit" value="No" id="dot-2-5">
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
                                <span class="btnsave">Save</span>
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

        document.addEventListener('DOMContentLoaded', function() {
            const saveButton = document.querySelector('.submit');

            if (saveButton) {
                saveButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    // Display SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to save this enrolment record?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, save it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms, submit the form via AJAX
                            saveFormData();
                        }
                    });
                });
            }

            // Function to submit form data via AJAX
            function saveFormData() {
                const form = document.querySelector('form');
                const formData = new FormData(form);

                // Send AJAX request
                fetch('/patient-enrolment/store', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Failed to save enrolment record, Please complete the form and ensure correct inputs.');
                        }
                    })
                    .then(data => {
                        // Show success message using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload the page after successful save
                            location.reload();
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth' // Smooth scrolling animation
                            });
                        });
                    })
                    .catch(error => {
                        // Show error message using SweetAlert
                        Swal.fire({
                            title: 'Oops!',
                            text: error.message,
                            icon: 'info',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    </script>
</body>

</html>
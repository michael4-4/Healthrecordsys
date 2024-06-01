<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Treatment Record</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-a`we`some/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/AddPatientTreatment.css')}}">
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
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/plus--v1.png" alt="plus--v1"/>&ensp;&nbsp;ADD TREATMENT RECORD</div>
        <div class="profile">
    
        <i class="fas fa-chevron-down arrow hover-pointer"></i>
            <ul class="profile-link">
					<li><a href="{{ route ('UserProfile') }}"><i class='bx bx-user-circle icon'></i> Profile</a></li>
					<li><a id="logout-btn" onclick="logout()" style="cursor: pointer;"><i class='bx bx-log-out icon'></i> Logout</a></li>
			</ul>
        </div>
    </nav>

     <!-- BREADCRUMBS -->
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('ViewRecords') }}" class="dark-grey">View Records</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('patient.view', ['id' => $patient->patient_id])}}" class="dark-grey">Patient Information</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
        <span class="breadcrumb-separator">&ensp;</span>Add Treatment Record</li>
    </ol>
    
    <!-- NAVBAR -->
<!-- Back Button -->
    <div class="button-container">
    <a href="{{ route('patient.view', ['id' => $patient->patient_id])}}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
<!-- MAIN -->
<main class="main-content">
    <div class="container4">
    <form action="{{ route('patient-treatment.store') }}" method="POST">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
            <div class="form1">
                <div class="details-personal">
                    <span class="title">PATIENT INFORMATION</span>
                    <div class="fields">
                        <div class="input-field info">
                            <label for="full_name">Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ $patient->first_name }} {{ $patient->last_name }}"  class="plain-text" readonly>
                        </div>
                        <div class="input-field info">
                            <label for="sex">Sex</label>
                            <input type="text" id="sex" name="sex" value="{{ $patient->sex }}" class="plain-text"readonly>
                        </div>
                        <div class="input-field info">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="{{ $patient->barangay }}" class="plain-text" readonly>
                        </div>
                        <div class="input-field info">
                            <label for="age">Age</label>
                            <input type="text" id="age" name="age" required>
                        </div>
                        <div class="input-field info">
                            <label for="religion">Religion</label>
                            <input type="text" id="religion" name="religion" required>
                        </div>
                    </div>
                    <hr>
                    <div class="fields">
                        <div class="input-field">
                            <label for="date_of_consultation">Date of Consultation</label>
                            <input type="date" id="date_of_consultation" name="date_of_consultation" required>
                        </div>
                        <div class="input-field">
                            <label for="consultation_time">Consultation Time</label>
                            <input type="time" id="consultation_time" name="consultation_time" required>
                        </div>
                        <div class="input-field">
                            <label for="mode_of_transaction">Mode of Transaction</label>
                            <select id="mode_of_transaction" name="mode_of_transaction" required>
                                <option disabled selected>Select</option>
                                <option value="Walk-in">Walk-in</option>
                                <option value="Visited">Visited</option>
                                <option value="Referral">Referral</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="blood_pressure">Blood Pressure</label>
                            <input type="text" id="blood_pressure" name="blood_pressure">
                        </div>
                        <div class="input-field">
                            <label for="temperature">Temperature</label>
                            <input type="text" id="temperature" name="temperature">
                        </div>
                        <div class="input-field">
                            <label for="height">Height (cm)</label>
                            <input type="text" id="height" name="height">
                        </div>
                        <div class="input-field">
                            <label for="weight">Weight (kg)</label>
                            <input type="text" id="weight" name="weight">
                        </div>
                        <div class="input-field">
                            <label for="allergies">Allergies</label>
                            <input type="text" id="allergies" name="allergies">
                        </div>
                        <div class="input-field">
                            <input type="radio" name="covid_vaccine" value="Vaccinated" id="dot-1-1">
                            <input type="radio" name="covid_vaccine" value="Unvaccinated" id="dot-2-1">
                            <span class="title" style="font-weight:bold;">COVID Vaccine</span>
                            <div class="category">
                                <label for="dot-1-1">
                                    <span class="dot one"></span>
                                    <span class="vaccine">Vaccinated</span>
                                </label>
                                <label for="dot-2-1">
                                    <span class="dot two"></span>
                                    <span class="vaccine">Unvaccinated</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field">
                            <label for="nature_of_visit">Nature of Visit</label>
                            <select id="nature_of_visit" name="nature_of_visit">
                                <option disabled selected>Select</option>
                                <option value="New Consultation/Case">New Consultation/Case</option>
                                <option value="New Admission">New Admission</option>
                                <option value="Follow-up Visit">Follow-up visit</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="type_of_consultation">Type of Consultation</label>
                            <select id="type_of_consultation" name="type_of_consultation" required>
                                <option disabled selected>Select</option>
                                <option value="General">General</option>
                                <option value="Prenatal">Prenatal</option>
                                <option value="Child Care">Child Care</option>
                                <option value="Child Immunization">Child Immunization</option>
                                <option value="Sick Children">Sick Children</option>
                                <option value="Child Nutrition">Child Nutrition</option>
                                <option value="Injury">Injury</option>
                                <option value="Adult Immunization">Adult Immunization</option>
                                <option value="Family Planning">Family Planning</option>
                                <option value="Postpartum">Postpartum</option>
                                <option value="Tuberculosis">Tuberculosis</option>
                                <option value="Firecracker Injury">Firecracker Injury</option>
                                <option value="Dental Care">Dental Care</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="attending_provider">Name of Attending Provider</label>
                            <input type="text" id="attending_provider" name="attending_provider">
                        </div>
                    </div>
                    <hr>
                    <div class="fields">
                        <div class="input-field r3">
                            <label for="diagnosis">Disease/Diagnosis</label>
                            <textarea id="diagnosis" name="diagnosis" style="height:160px"></textarea>
                        </div>
                        <div class="input-field r3">
                            <label for="medication">Medication/Treatment</label>
                            <textarea id="medication" name="medication" style="height:160px"></textarea>
                        </div>
                        <div class="input-field r3">
                            <label for="laboratory_findings">Laboratory Findings/Impression</label>
                            <textarea id="laboratory_findings" name="laboratory_findings" style="height:160px"></textarea>
                        </div>
                        <div class="input-field r3">
                            <label for="performed_laboratory_test">Performed Laboratory Test</label>
                            <input type="text" id="performed_laboratory_test" name="performed_laboratory_test">
                        </div>
                        <div class="input-field r3">
                            <label for="healthcare_provider">Name of Healthcare Provider</label>
                            <input type="text" id="healthcare_provider" name="healthcare_provider">
                        </div>
                    </div>
                    <hr>
                    <span class="title2">FOR REFERRAL TRANSACTION</span>
                    <div class="fields">
                        <div class="input-field referral">
                            <label for="referred_from">Referred from</label>
                            <input type="text" id="referred_from" name="referred_from">
                        </div>
                        <div class="input-field referral">
                            <label for="referred_to">Referred to</label>
                            <input type="text" id="referred_to" name="referred_to">
                        </div>
                        <div class="input-field referral">
                            <label for="reason_for_referral">Reason(s) for Referral</label>
                            <textarea id="reason_for_referral" name="reason_for_referral" style="height:160px"></textarea>
                        </div>
                        <div class="input-field referral">
                            <label for="chief_complaints">Chief Complaints</label>
                            <textarea id="chief_complaints" name="chief_complaints" style="height:160px"></textarea>
                        </div>
                        <div class="input-field referral">
                            <label for="referred_by">Referred by</label>
                            <input type="text" id="referred_by" name="referred_by">
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


    document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.querySelector('.submit');

    if (saveButton) {
        saveButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save this treatment record?',
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
        fetch('/patient-treatment/store', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Failed to save treatment record, Please complete the form and ensure correct inputs.');
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

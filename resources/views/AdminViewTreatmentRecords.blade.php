<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Individual Treatment Record</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/AdminViewTreatmentRecords.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
    <a href="#" class="brand2"><img src="{{asset('images/logoend.png')}}" alt="logo"></a>
    <ul class="side-menu">
        <li><a href="{{route ('AdminDashboard')}}"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
        <li><a href="{{route ('AdminViewRecords')}}"  class="active"><i class='bx bxs-user-detail icon' ></i> Patient Records</a></li>
        <li><a href="{{route ('AdminManageAccounts')}}"><i class='bx bxs-cog icon' ></i> Manage Accounts</a></li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu toggle-sidebar'></i>
        <span class="divider"></span>
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/task.png" alt="task"/>&ensp;&nbsp;INDIVIDUAL TREATMENT RECORD</div>
        <div class="profile">
        
            <i class="fas fa-chevron-down arrow hover-pointer"></i>
				<ul class="profile-link">
					<li><a href="{{ route ('AdminProfile') }}"><i class='bx bx-user-circle icon'></i> Profile</a></li>
					<li><a id="logout-btn" onclick="logout()" style="cursor: pointer;"><i class='bx bx-log-out icon'></i> Logout</a></li>
				</ul>
        </div>
    </nav>
    <!-- NAVBAR -->

    <!-- BREADCRUMBS -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('AdminViewRecords') }}" class="dark-grey">Patient Records</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('AdminViewPatientInfo', ['id' => $patient->patient_id, 'treatment_id' => $treatmentRecord->treatment_id])}}" class="dark-grey">Patient Information</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
        <span class="breadcrumb-separator">&ensp;</span>View Treatment Record</li>
    </ol>

    <!-- Back Button and Download -->
    <div class="button-container">
    <a href="{{ route('AdminViewPatientInfo', ['id' => $patient->patient_id, 'treatment_id' => $treatmentRecord->treatment_id])}}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    <a id="downloadPdfButton" href="{{ route('treatment.download.pdf', ['id' => $patient->patient_id, 'treatment_id' => $treatmentRecord->treatment_id]) }}" class="download-button"><i class="fas fa-download"></i> Download as PDF</a>
    </div>

<!-- MAIN -->
<main class="main-content">
@section('content')
	<div class="container2">
        <div class="form-patient">
            <div class="details-personal">
            <div class="patient-info-title">
                <span class="title3">PATIENT INFORMATION</span>
            </div>
                <div class="fields1">
                <div class="input-field1">
                        <label for="fullname">Name: </label>
                        <input type="text" id="fullname" name="fullname" value="{{ $patient->first_name }} {{ $patient->last_name }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="sex">Sex: </label>
                        <input type="text" id="sex" name="sex" value="{{ $patient->sex}}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="{{ $patient->barangay }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="age">Age:</label>
                        <input type="text" id="age" name="age" value="{{ $treatmentRecord->age }}" readonly>         
                    </div>
                    <div class="input-field1">
                        <label for="religion">Religion:</label>
                        <input type="text" id="religion" name="religion" value="{{ $treatmentRecord->religion }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="dateconsult">Date of Consultation:</label>
                        <input type="date" id="dateconsult" name="dateconsult" value="{{ $treatmentRecord->date_of_consultation }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="consultime">Consultation Time:</label>
                        <input type="time" id="consultime" name="consultime" value="{{ $treatmentRecord->consultation_time }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="modetransact">Mode of Transaction:</label>
                        <input type="text" id="modetransact" name="modetransact" value="{{ $treatmentRecord->mode_of_transaction }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="bloodpres">Blood Pressure:</label>
                        <input type="text" id="bloodpres" name="bloodpres" value="{{ $treatmentRecord->blood_pressure }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="temperature">Temperature</label>
                        <input type="text" id="temperature" name="temperature" value="{{ $treatmentRecord->temperature }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="height">Height (cm):</label>
                        <input type="text" id="height" name="height" value="{{ $treatmentRecord->height }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="weight">Weight (kg):</label>
                        <input type="text" id="weight" name="weight" value="{{ $treatmentRecord->weight }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="allergy">Allergies:</label>
                        <input type="text" id="allergy" name="allergy" value="{{ $treatmentRecord->allergies }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="vaccine">COVID Vaccine:</label>
                        <input type="text" id="vaccine" name="vaccine" value="{{ $treatmentRecord->covid_vaccine }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="naturevisit">Nature of Visit:</label>
                        <input type="text" id="naturevisit" name="naturevisit" value="{{ $treatmentRecord->nature_of_visit }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="typeconsult">Type of Consultation:</label>
                        <input type="text" id="typeconsult" name="typeconsult" value="{{ $treatmentRecord->type_of_consultation }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="attending_prov">Name of Attending Provider:</label>
                        <input type="text" id="attending_prov" name="attending_prov" value="{{ $treatmentRecord->attending_provider }}" readonly>
                    </div>
                </div>
                <hr>
                    <div class="fields2">
                    <div class="input-field1">
                        <label for="diagnosis">Disease/Diagnosis:</label>
                        <textarea id="diagnosis" name="diagnosis" style="height:120px">{{ $treatmentRecord->diagnosis }}</textarea>
                    </div>
                    <div class="input-field1">
                        <label for="medication">Medication/Treatment:</label>
                        <textarea id="medication" name="medication" style="height:120px">{{ $treatmentRecord->medication }}</textarea>
                    </div>
                    <div class="input-field1">
                        <label for="labfindings">Laboratory Findings/Impression:</label>
                        <textarea id="labfindings" name="labfindings" style="height:120px">{{ $treatmentRecord->laboratory_findings }}</textarea>
                    </div>
                    <div class="input-field1">
                        <label for="performed_lab">Performed Laboratory Test:</label>
                        <input type="text" id="performed_lab" name="performed_lab" value="{{ $treatmentRecord->performed_laboratory_test }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="health_provider">Name of Healthcare Provider:</label>
                        <input type="text" id="health_provider" name="health_provider" value="{{ $treatmentRecord->healthcare_provider }}" readonly>
                    </div>
                    </div>

                    <hr>
                    <span class="title3">FOR REFERRAL TRANSACTION</span>
                    <div class="fields3">
                        <div class="input-field1">
                            <label for="referred_from">Referred from</label>
                            <input type="text" id="referred_from" name="referred_from" value="{{ $treatmentRecord->referred_from }}" readonly>
                        </div>
                        <div class="input-field1">
                            <label for="referred_to">Referred to</label>
                            <input type="text" id="referred_to" name="referred_to" value="{{ $treatmentRecord->referred_to }}" readonly>
                        </div>
                        <div class="input-field1">
                            <label for="referral_reason">Reason(s) for Referral</label>
                            <textarea id="referral_reason" name="referral_reason" style="height:120px">{{ $treatmentRecord->reason_for_referral }}</textarea>
                        </div>
                        <div class="input-field1">
                            <label for="chief_complaints">Chief Complaints</label>
                            <textarea id="chief_complaints" name="chief_complaints" style="height:120px">{{ $treatmentRecord->chief_complaints }}</textarea>
                        </div>
                        <div class="input-field1">
                            <label for="referred_by">Referred by</label>
                            <input type="text" id="referred_by" name="referred_by" value="{{ $treatmentRecord->referred_by }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show
</main>
   

</section>
<!-- NAVBAR -->

<script src="{{ asset ('script.js')}}"></script>
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
                form.action = "{{ route('adminlogout') }}";
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

    document.getElementById('downloadPdfButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor tag behavior
        
        // Show the Sweet Alert confirmation
        Swal.fire({
            title: 'Download PDF?',
            text: 'Are you sure you want to download the PDF?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, download it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, proceed to download the PDF
                var downloadUrl = "{{ route('treatment.download.pdf', ['id' => $patient->patient_id, 'treatment_id' => $treatmentRecord->treatment_id]) }}";
                var newTab = window.open(downloadUrl, '_blank');
                newTab.focus();
            }
        });
    });

</script>

</body>
</html>

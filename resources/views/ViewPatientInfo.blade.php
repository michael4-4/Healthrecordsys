<!--
$fullname = $patientData['fname'] . ' ' . $patientData['middlename'] . ' ' . $patientData['lname'];
if (!empty($patientData['Suffix'])) {
    $fullName .= ' ' . $patientData['Suffix'];
}
// Concatenate address
$address = $patientData['barangay'] . ', ' . $patientData['municipality'] . ', ' . $patientData['province'];
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Information</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/ViewPatientInfo.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/task.png" alt="task"/>&ensp;&nbsp;PATIENT INFORMATION</div>
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
        <li class="breadcrumb-item"><a href="{{ route('ViewRecords') }}" class="dark-grey">View Records</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
            <span class="breadcrumb-separator">&ensp;</span>Patient Information</li>
    </ol>


    <!-- NAVBAR -->
    <!-- Back Button and Download -->
    <div class="button-container">
    <a href="{{ route('ViewRecords') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    <!-- Download Form -->
    <!-- Include the patient's ID in the route -->
    <a id="downloadPdfButton" href="{{ route('patient.download.pdf', ['id' => $patient->patient_id]) }}" class="download-button"><i class="fas fa-download"></i> Download as PDF</a>
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
                @unless(request()->is('patient/*/download-pdf')) <!-- Hide 'Edit' link in PDF -->
                <a href="{{ route('patient.edit', $patient->patient_id) }}" class="edit-link"><i class='bx bx-pencil'></i> Edit</a>
                @endunless
                <div class="fields">
                    <div class="input-field1">
                        <label for="full_name">Name: </label>
                        <input type="text" id="full_name" name="full_name" value="{{ $patient->first_name }} {{ $patient->last_name }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="sex">Sex: </label>
                        <input type="text" id="sex" name="sex" value="{{ $patient->sex }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="civil_status">Civil Status: </label>
                        <input type="text" id="civil_status" name="civil_status" value="{{ $patient->civil_status }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="maiden_name">Maiden Name (married women):</label>
                        <input type="text" id="maiden_name" name="maiden_name" value="{{ $patient->maiden_name }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="mother_name">Mother's Name:</label>
                        <input type="text" id="mother_name" name="mother_name" value="{{ $patient->mother_name }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="spouse_name">Spouse's Name:</label>
                        <input type="text" id="spouse_name" name="spouse_name" value="{{ $patient->spouse_name }}" readonly>
                    </div>                                        
                    <div class="input-field1">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $patient->date_of_birth }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="blood_type">Blood Type:</label>
                        <input type="text" id="blood_type" name="blood_type" value="{{ $patient->blood_type }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" id="contact_number" name="contact_number" value="{{ $patient->contact_number }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="educational_attainment">Educational Attainment:</label>
                        <input type="text" id="educational_attainment" name="educational_attainment" value="{{ $patient->educational_attainment }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="employment_status">Employment Status:</label>
                        <input type="text" id="employment_status" name="employment_status" value="{{ $patient->employment_status }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="family_member">Family Member:</label>
                        <input type="text" id="family_member" name="family_member" value="{{ $patient->family_member }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="{{ $patient->barangay }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="dswd_nhts">DSWD NHTS:</label>
                        <input type="text" id="dswd_nhts" name="dswd_nhts" value="{{ $patient->dswd_nhts }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="facility_house_number">Facility House No.:</label>
                        <input type="text" id="facility_house_number" name="facility_house_number" value="{{ $patient->facility_house_number }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="fourps_member">4ps Member:</label>
                        <input type="text" id="fourps_member" name="fourps_member" value="{{ $patient->fourps_member }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="household_number">Household No.:</label>
                        <input type="text" id="household_number" name="household_number" value="{{ $patient->household_number }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="philhealth_number">Philhealth Member:</label>
                        <input type="text" id="philhealth_number" name="philhealth_number" value="{{ $patient->philhealth_member }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="status_type">Status Type:</label>
                        <input type="text" id="status_type" name="status_type" value="{{ $patient->status_type }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="philhealth_number">Philhealth No.:</label>
                        <input type="text" id="philhealth_number" name="philhealth_number" value="{{ $patient->philhealth_number }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="member_category">Category (if member):</label>
                        <input type="text" id="member_category" name="member_category" value="{{ $patient->member_category }}" readonly>
                    </div>
                    <div class="input-field1">
                        <label for="primary_care_benefit">Primary Care Benefit (PCB):</label>
                        <input type="text" id="primary_care_benefit" name="primary_care_benefit" value="{{ $patient->primary_care_benefit }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container3">
        <span class="title3">TREATMENT RECORD</span>
        @unless(request()->is('patient/*/download-pdf')) <!-- Hide 'Edit' link in PDF -->
        <a href="{{ route('AddPatientTreatment', ['id' => $patient->patient_id]) }}" class="add-button"><i class='bx bx-plus'></i>Add</a>
        @endunless
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 5%">Number</th>
                    <th style="width: 5%">Date</th>
                    <th style="width: 8%">Mode of Transaction</th>
                    <th style="width: 8%">Type of Consultation</th>
                    @unless(request()->is('patient/*/download-pdf'))
                    <th style="width: 5%">Action</th>
                    @endunless
                </tr>
            </thead>
            <tbody>
                @forelse($treatmentRecords as $index => $treatment_record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $treatment_record->date_of_consultation }}</td>
                    <td>{{ $treatment_record->mode_of_transaction }}</td>
                    <td>{{ $treatment_record->type_of_consultation }}</td>
                    @unless(request()->is('patient/*/download-pdf'))
                    <td>
                    <a href="{{ route('treatment.view', ['id' => $patient->patient_id, 'treatment_id' => $treatment_record->treatment_id]) }}" class="view-button" title="View"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('treatment.edit', ['id' => $patient->patient_id, 'treatment_id' => $treatment_record->treatment_id]) }}" class="edit-button" title="Edit"><i class="fas fa-edit"></i></a>
                    </td>
                    @endunless
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; font-style: oblique;">No treatment records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @unless(request()->is('patient/*/download-pdf')) <!-- Hide 'Edit' link in PDF -->
        <div class="pagination" style="display: flex; justify-content: flex-end; margin-top: 20px;">
        <div class="page-number" style="margin-left: 10px; font-size: 15px; font-weight: medium; margin-right: auto; padding: 10px 20px 10px;">
              Page {{ $treatmentRecords->currentPage() }} of {{ $treatmentRecords->lastPage() }}
        </div>
        @if ($treatmentRecords->previousPageUrl())
        <a href="{{ $treatmentRecords->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
        @else
        <span class="pagination-link disabled">&laquo; Previous</span>
        @endif

        @if ($treatmentRecords->nextPageUrl())
        <a href="{{ $treatmentRecords->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
        @else
        <span class="pagination-link disabled">Next &raquo;</span>
        @endif
        @endunless
    </div>
    @show
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
                var downloadUrl = "{{ route('patient.download.pdf', ['id' => $patient->patient_id]) }}";
                var newTab = window.open(downloadUrl, '_blank');
                newTab.focus();
            }
        });
    });

    
    </script>
</body>
</html>

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
    <link rel="stylesheet" href="{{ asset('css/AdminViewPatientInfo.css') }}">
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
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/task.png" alt="task"/>&ensp;&nbsp;PATIENT INFORMATION</div>
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
        <li class="breadcrumb-item"><a href="{{ route('AdminViewRecords') }}" class="dark-grey">Patient Records</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
            <span class="breadcrumb-separator">&ensp;</span>Patient Information</li>
    </ol>

    <!-- Back Button and Download -->
    <div class="button-container">
    <a href="{{ route('AdminViewRecords') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    <a id="downloadPdfButton" href="{{ route('patient.download.pdf', ['id' => $patient->patient_id]) }}" class="download-button"><i class="fas fa-download"></i> Download as PDF</a>
    </div>

<!-- MAIN -->
<main class="main-content">
@section('content')
	<div class="container2">
        <div class="form-patient">
            <div class="details-personal">
                <span class="title3">PATIENT INFORMATION</span>
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
                        <input type="text" id="philhealth_number" name="philhealth_number" value="{{ $patient->philhealth_number }}" readonly>
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
        <table class="custom-table">
        <thead>
                <tr>
                    <th style="width: 5%">Number</th>
                    <th style="width: 5%">Date</th>
                    <th style="width: 8%">Mode of Transaction</th>
                    <th style="width: 8%">Type of Consultation</th>
                    <th style="width: 5%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($treatmentRecords as $index => $treatment_record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $treatment_record->date_of_consultation }}</td>
                        <td>{{ $treatment_record->mode_of_transaction }}</td>
                        <td>{{ $treatment_record->type_of_consultation }}</td>
                        <td>
                        <a href="{{ route('AdminViewTreatmentRecords', ['id' => $patient->patient_id, 'treatment_id' => $treatment_record->treatment_id]) }}" class="view-button" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('AdminDeleteTreatmentRecords', ['id' => $patient->patient_id, 'treatment_id' => $treatment_record->treatment_id]) }}" class="delete-button" title="Delete" onclick="deleteUser(event, {{ $patient->patient_id }}, {{ $treatment_record->treatment_id }});"><i class="fas fa-trash-alt"></i></a>

                        </td>
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
    
    function deleteUser(event, patientId, treatmentId) {
    event.preventDefault(); // Prevent default anchor behavior
    
    // Show confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you really want to delete this treatment record? This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with deletion
            // Send AJAX request to delete treatment record
            fetch(`/admin/delete_treatment_record/${patientId}/${treatmentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success'
                }).then((result) => {
                    // Wait for user to click "OK" before reloading
                    if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                });
            })
            .catch(error => {
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error'
                });
            });
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

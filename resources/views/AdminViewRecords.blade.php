<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Records</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/AdminViewRecords.css')}}">
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
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/100/show-property.png" alt="show-property"/>&ensp;&nbsp;PATIENT RECORDS</div>
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
        <li class="breadcrumb-item"><a href="{{ route('AdminDashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
            <span class="breadcrumb-separator">&ensp;</span>Patient Records</li>
    </ol>

<!-- MAIN -->
<main>
	<div class="container1">

    <div class="search-filter-container">
            <form action="" method="GET" class="search-form">
                <div class="search-container">
                    <input type="text" name="search_query" placeholder="Search..." class="search-input">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </div>
            </form>            
            
            <form action="" method="GET" class="filter-form" id="filterForm">
        <label for="filter">Filter by Barangay:</label>
        <select name="filter" id="filter">
            <option disabled selected>Select</option>
            <option value="Show All" {{ Request::input('filter') == 'Show All' ? 'selected' : '' }}>Show All</option>
            <option value="Acnam" {{ Request::input('filter') == 'Acnam' ? 'selected' : '' }}>Acnam</option>
            <option value="Barikir" {{ Request::input('filter') == 'Barikir' ? 'selected' : '' }}>Barikir</option>
            <option value="Barangobong" {{ Request::input('filter') == 'Barangobong' ? 'selected' : '' }}>Barangobong</option>
            <option value="Bugayong" {{ Request::input('filter') == 'Bugayong' ? 'selected' : '' }}>Bugayong</option>
            <option value="Caray" {{ Request::input('filter') == 'Caray' ? 'selected' : '' }}>Caray</option>
            <option value="Cabitauran" {{ Request::input('filter') == 'Cabitauran' ? 'selected' : '' }}>Cabitauran</option>
            <option value="Garnaden" {{ Request::input('filter') == 'Garnaden' ? 'selected' : '' }}>Garnaden</option>
            <option value="Naguilian" {{ Request::input('filter') == 'Naguilian' ? 'selected' : '' }}>Naguilian</option>
            <option value="Poblacion" {{ Request::input('filter') == 'Poblacion' ? 'selected' : '' }}>Poblacion</option>
            <option value="Sto. Nino" {{ Request::input('filter') == 'Sto. Nino' ? 'selected' : '' }}>Sto. Nino</option>
            <option value="Uguis" {{ Request::input('filter') == 'Uguis' ? 'selected' : '' }}>Uguis</option>
        </select>
    </form>

            
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 5%">Number</th>
                    <th style="width: 8%">Last Name</th>
                    <th style="width: 8%">First Name</th>
                    <th style="width: 10%">Address</th>
                    <th style="width: 3%">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($patients as $index => $patient)
            <tr>
                <td>{{ $startNumber + $index }}</td> <!-- Display row number -->
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->first_name }}</td>
                <!-- Display other user attributes as needed -->
                <td>{{ $patient->barangay }}</td>
                <td>
                    <!-- Add action buttons (view, edit, delete) as needed -->
                    <a href="{{ route('AdminViewPatientInfo', $patient->patient_id) }}" class="view-button" title="View"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('AdminDeleteRecords',  $patient->patient_id) }}" class="delete-button" title="Delete" onclick="deleteUser(event, {{ $patient->patient_id }});"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; font-style: oblique;">No patient records found</td>
            </tr>
            @endforelse
        </tbody>
            
        </table>
        
        
        <div class="pagination" style="display: flex; justify-content: flex-end; margin-top: 20px;">
        <!-- Page Number -->
        <div class="page-number" style="margin-left: 10px; font-size: 15px; font-weight: medium; margin-right: auto; padding: 10px 20px 10px;">
            Page {{ $patients->currentPage() }} of {{ $patients->lastPage() }}
        </div>

        <!-- Previous Page Link -->
        @if ($patients->onFirstPage())
            <a class="pagination-link disabled">&laquo; Previous</a>
        @else
            <a href="{{ $patients->previousPageUrl() }}{{ Request::has('filter') ? '&filter=' . Request::input('filter') : '' }}{{ Request::has('search_query') ? '&search_query=' . Request::input('search_query') : '' }}" class="pagination-link">&laquo; Previous</a>
        @endif

        <!-- Next Page Link -->
        @if ($patients->hasMorePages())
            <a href="{{ $patients->nextPageUrl() }}{{ Request::has('filter') ? '&filter=' . Request::input('filter') : '' }}{{ Request::has('search_query') ? '&search_query=' . Request::input('search_query') : '' }}" class="pagination-link">Next &raquo;</a>
        @else
            <a class="pagination-link disabled">Next &raquo;</a>
        @endif
    </div>
        
        </div>
    </div>
</main>
   

</section>
<!-- NAVBAR -->

<script src="{{ asset ('script.js')}}"></script>
<script>
    document.getElementById('filter').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

<script>
    document.querySelector('.search-form input[name="search_query"]').addEventListener('input', function() {
        document.getElementById('searchForm').submit();
    });
</script>

<script>
    // JavaScript function to display a confirmation message using SweetAlert2
    function deleteUser(event, patientId) {
        event.preventDefault(); // Prevent default anchor behavior
        
        // Show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this user? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                // Send AJAX request to delete user
                fetch(`/admin/delete_records/${patientId}`, {
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
</script>
</body>
</html>
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
    <link rel="stylesheet" href="{{asset ('css/ViewRecords.css')}}">
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
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/search-property.png" alt="search-property"/>&ensp;&nbsp;PATIENT RECORDS</div>
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
            <span class="breadcrumb-separator">&ensp;</span>View Records</li>
    </ol>

     <!-- Back Button and Download -->
     <div class="button-container">
        <a id="downloadPdfButton" href="" class="download-button"><i class="fas fa-download"></i> Download</a>
    </div>
    
<!-- MAIN -->
<main>
@section('content')
	<div class="container1">
    @unless(request()->is('download-view-records-pdf'))
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
        @endunless
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 5%">Number</th>
                    <th style="width: 8%">Last Name</th>
                    <th style="width: 8%">First Name</th>
                    <th style="width: 10%">Address</th>
                    @unless(request()->is('download-view-records-pdf'))
                    <th style="width: 3%">Action</th>
                    @endunless
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
                @unless(request()->is('download-view-records-pdf'))
                <td>
                    <!-- Add action buttons (view, edit, delete) as needed -->
                    <a href="{{ route('patient.view', $patient->patient_id) }}" class="view-button" title="View"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('patient.edit', $patient->patient_id) }}" class="edit-button" title="Edit"><i class="fas fa-edit"></i></a>
                </td>
                @endunless
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; font-style: oblique;">No patient records found</td>
            </tr>
            @endforelse
        </tbody>
            
        </table>
        
        @unless(request()->is('download-view-records-pdf'))
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
        @endunless
    </div>

        
        </div>
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

    // Function to handle barangay filter change
    document.getElementById('filter').addEventListener('change', function() {
        // Submit the form when barangay selection changes
        document.getElementById('filterForm').submit();
    });

    document.querySelector('.search-form input[name="search_query"]').addEventListener('input', function() {
        document.getElementById('searchForm').submit();
    });


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
            let filter = document.getElementById('filter').value;
            let searchQuery = document.querySelector('input[name="search_query"]').value;
            let downloadUrl = `{{ route('download.view.records.pdf') }}?filter=${filter}&search_query=${searchQuery}`;
            var newTab = window.open(downloadUrl, '_blank');
            newTab.focus();
        }
    });
});


</script>

</body>
</html>

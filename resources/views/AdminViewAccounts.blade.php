<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Accounts</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/AdminViewAccounts.css')}}">
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
        <li><a href="{{route ('AdminViewRecords')}}"><i class='bx bxs-user-detail icon' ></i> Patient Records</a></li>
        <li><a href="{{route ('AdminManageAccounts')}}" class="active"><i class='bx bxs-cog icon' ></i> Manage Accounts</a></li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu toggle-sidebar'></i>
        <span class="divider"></span>
        <div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/view-file.png" alt="view-file"/>&ensp;&nbsp;USER INFORMATION</div>
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
        <li class="breadcrumb-item"><a href="{{ route('AdminDashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>&ensp;
        <li class="breadcrumb-item"><a href="{{ route('AdminManageAccounts') }}" class="dark-grey">Manage Accounts</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
            <span class="breadcrumb-separator">&ensp;</span>User Information</li>
    </ol>

    <!-- Back Button and Download -->
    <div class="button-container">
    <a href="{{ route('AdminManageAccounts') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

<!-- MAIN -->
<main class="main-content">
	<div class="container4">
        <div class="form-users">
            <div class="details-personal">
                <span class="title3">USER INFORMATION</span>
                <div class="fields-user">
                <a href="{{ route('AdminDeleteAccounts', ['id' => $user->id]) }}" class="delete-link" title="Delete" onclick="deleteUser(event, {{ $user->id }});"><i class='bx bx-trash'></i>Delete</a>
                    <div class="image-holder">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/Defaultprofile-modified.png') }}" alt="User Image">
                    </div>
                    <div class="input-field2">
                        <label for="firstName">First Name: </label>
                        <input type="text" id="firstName" name="firstName" value="{{ $user->firstname }}" readonly>
                    </div>
                    <div class="input-field2">
                        <label for="lastName">Last Name: </label>
                        <input type="text" id="lastName" name="lastName" value="{{ $user->lastname }}" readonly>
                    </div>
                    <div class="input-field2">
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="input-field2">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" value="{{ $user->position }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
   

</section>
<!-- NAVBAR -->

<script src="{{ asset ('script.js')}}"></script>
<script>
    // JavaScript function to display a confirmation message using SweetAlert2
    function confirmDelete() {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this user? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            return result.isConfirmed;
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


    // JavaScript function to display a confirmation message using SweetAlert2
    function deleteUser(event, userId) {
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
                fetch(`/admin/delete_accounts/${userId}`, {
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
                            window.location.href = "{{ route('AdminManageAccounts') }}";
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
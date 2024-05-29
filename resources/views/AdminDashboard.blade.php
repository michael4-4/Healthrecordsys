<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- custom css -->
    <!-- bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- fontawesome, boxicons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/AdminDashboard.css')}}">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- utilize chart.js -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> <!-- utilize plot.ly -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.1.0/chroma.min.js"></script>
</head>
<body>
	
	<!-- SIDEBAR -->
	<section id="sidebar">
        <a href="#" class="brand"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
        <a href="#" class="brand2"><img src="{{asset('images/logoend.png')}}" alt="logo"></a>
		<ul class="side-menu">
			<li><a href="{{route ('AdminDashboard')}}" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li><a href="{{route ('AdminViewRecords')}}"><i class='bx bxs-user-detail icon'></i> Patient Records</a></li>
			<li><a href="{{route ('AdminManageAccounts')}}"><i class='bx bxs-cog icon'></i> Manage Accounts</a></li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar'></i>
			<span class="divider"></span>
			<div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/performance-macbook.png" alt="performance-macbook"/>&ensp;&nbsp;DASHBOARD</div>
            
            <div class="welcome-message">
            <p>Welcome, {{ $admin->role }}! {{ $admin->firstname }}</p>
            </div>
            <div class="profile-pictureupper">
                <div class="image-holder"></div>
                <img id="profilePicturePreview" src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('images/Defaultprofile-modified.png') }}" alt="Profile Picture">
            </div>

			<div class="profile"> 
				<i class="fas fa-chevron-down arrow hover-pointer"></i>
				<ul class="profile-link">
					<li><a href="{{ route ('AdminProfile') }}"><i class='bx bx-user-circle icon'></i> Profile</a></li>
					<li><a id="logout-btn" onclick="logout()" style="cursor: pointer;"><i class='bx bx-log-out icon'></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
        <div class="containerx">
        <iframe title="finaldashboard" width="1050" height="651" src="https://app.powerbi.com/view?r=eyJrIjoiMDAzOTZkMGUtYzVlOC00ZmU4LWEyMDEtYzI1MzkwZDE0NmZhIiwidCI6IjdjZmY5YzA2LThmNGQtNDAwNi1iOWQwLWU4MWRjYWJjZDU1NyIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>

    </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
	</script>
    
</body>
</html>

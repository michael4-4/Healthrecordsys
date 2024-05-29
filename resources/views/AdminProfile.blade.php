<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome, Boxicons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset ('css/AdminProfile.css')}}">
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
			<div class="title-form"><img width="25" height="25" src="https://img.icons8.com/color-glass/48/admin-settings-male.png" alt="admin-settings-male"/>&ensp;&nbsp;PROFILE</div>
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
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('AdminDashboard') }}" class="dark-grey">Dashboard</a></li>&ensp; <i class="bi bi-chevron-right"></i>
        <li class="active blue-green">
            <span class="breadcrumb-separator">&ensp;</span>Profile</li>
    </ol>

<!-- MAIN -->
<main>
    <div class="container5">
    <div class="content-wrapper">

    <div class="left-section">
    <div class="profile-picture">
        <div class="image-holder"></div>
        <img id="profilePicturePreview" src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('images/Defaultprofile-modified.png') }}" alt="Profile Picture">
    </div>
        <label for="profilePictureInput" class="upload-btn">Update Photo</label>
        <input type="file" id="profilePictureInput" style="display: none;">
        <button id="deletePhotoBtn" class="delete-btn">Delete Photo</button>
    </div>

        <div class="right-section">
            <div class="container6">
                <div class="tabs">
                    <button class="tablink active" onclick="openTab(event, 'profileInformation')">Profile Information</button>
                    <button class="tablink" onclick="openTab(event, 'editInformation')">Edit Information</button>
                    <button class="tablink" onclick="openTab(event, 'changePassword')">Change Password</button>
                </div>

                <div id="profileInformation" class="tabcontent" style="display: block;">
                    <div class="form-profile">
                        <div class="details-personal">
                            <div class="fields-profile">
                                <div class="input-field">
                                    <label for="firstName">First Name: </label>
                                    <input type="text" id="firstName" name="firstName" value="{{ $admin->firstname }}" disabled>
                                </div>
                                <div class="input-field">
                                    <label for="lastName">Last Name: </label>
                                    <input type="text" id="lastName" name="lastName" value="{{ $admin->lastname }}" disabled>
                                </div>
                                <div class="input-field">
                                    <label for="role">Role: </label>
                                    <input type="text" id="role" name="role" value="{{ $admin->role }}" disabled>
                                </div>
                                <div class="input-field">
                                    <label for="email">Email: </label>
                                    <input type="text" id="email" name="email" value="{{ $admin->email }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="editInformation" class="tabcontent">
                <div class="form-profile">
                    <div class="details-personal">
                        <div class="fields-profile">
                            <div class="input-field">
                                <label for="firstnamee">First Name: </label>
                                <input type="text" id="firstnamee" name="firstnamee" value="{{ $admin->firstname }}">
                            </div>
                            <div class="input-field">
                                <label for="lastnamee">Last Name: </label>
                                <input type="text" id="lastnamee" name="lastnamee" value="{{ $admin->lastname }}">
                            </div>
                            <div class="input-field">
                                <label for="rolee">Role: </label>
                                <select id="rolee" name="rolee">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $admin->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field">
                                <label for="emaill">Email: </label>
                                <input type="email" id="emaill" name="emaill" value="{{ $admin->email }}">
                            </div>
                        </div>
                    </div>
                </div>
                    
                    <!-- Update button -->
                    <div class="button">
                        <button class="submit" onclick="confirmUpdate()">
                            <span class="btnsave">Update</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
                
                <div id="changePassword" class="tabcontent">
                    <div class="form-profile">
                        <div class="details-personal">
                            <div class="fields-profile">
                                <div class="input-field">
                                    <label for="currentpasswordd">Current Password: </label>
                                    <input type="password" id="currentpasswordd" name="currentpasswordd" placeholder="Enter current password">
                                    <span class="toggle-password" onclick="togglePasswordVisibility('currentpasswordd')">
                                        <i class="fas fa-eye" id="currentpassworddToggle"></i>
                                    </span>
                                </div>
                                <div class="input-field">
                                    <label for="newpasswordd">New Password: </label>
                                    <input type="password" id="newpasswordd" name="newpasswordd" placeholder="Enter new password">
                                    <span class="toggle-password" onclick="togglePasswordVisibility('newpasswordd')">
                                        <i class="fas fa-eye" id="newpassworddToggle"></i>
                                    </span>
                                </div>
                                <div class="input-field">
                                    <label for="confirmpasswordd">Confirm New Password: </label>
                                    <input type="password" id="confirmpasswordd" name="confirmpasswordd" placeholder="Confirm new password">
                                    <span class="toggle-password" onclick="togglePasswordVisibility('confirmpasswordd')">
                                        <i class="fas fa-eye" id="confirmpassworddToggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Update button -->
                    <div class="button">
                        <button class="submit" onclick="confirmUpdatePass()">
                            <span class="btnsave">Update</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>


</section>
<!-- NAVBAR -->
<script src="{{ asset ('script2.js')}}"></script>
    <script>
        function openTab(evt, tabName) {
        // Get all elements with class="tabcontent" and hide them
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablink" and remove the class "active"
        var tablinks = document.getElementsByClassName("tablink");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
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

    function confirmUpdate() {
    // Display SweetAlert confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to update your profile information?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        // If user confirms, proceed with update
        if (result.isConfirmed) {
            // Call the function to update the profile
            updateProfile();
        }
    });
}

function updateProfile() {
    // Get the original values from the form fields
    var originalFirstname = "{{ $admin->firstname }}";
    var originalLastname = "{{ $admin->lastname }}";
    var originalRole = "{{ $admin->role }}";
    var originalEmail = "{{ $admin->email }}";

    // Get the updated values from the form fields
    var firstname = document.getElementById('firstnamee').value;
    var lastname = document.getElementById('lastnamee').value;
    var role = document.getElementById('rolee').value;
    var email = document.getElementById('emaill').value;

    // Check if any of the fields are empty
if (firstname === '') {
    // Display an error message using Sweet Alert
    Swal.fire({
        title: 'Cannot Update',
        text: 'First name cannot be empty.',
        icon: 'error',
        // Add a confirm button to the SweetAlert dialog
        showConfirmButton: true
    }).then((result) => {
        // Reload the page only after the user clicks the OK button
        if (result.isConfirmed) {
            location.reload();
        }
    });
    return; // Exit the function
}

if (lastname === '') {
    // Display an error message using Sweet Alert
    Swal.fire({
        title: 'Cannot Update',
        text: 'Last name cannot be empty.',
        icon: 'error',
        // Add a confirm button to the SweetAlert dialog
        showConfirmButton: true
    }).then((result) => {
        // Reload the page only after the user clicks the OK button
        if (result.isConfirmed) {
            location.reload();
        }
    });
    return; // Exit the function
}

if (role === '') {
    // Display an error message using Sweet Alert
    Swal.fire({
        title: 'Cannot Update',
        text: 'Role cannot be empty.',
        icon: 'error',
        // Add a confirm button to the SweetAlert dialog
        showConfirmButton: true
    }).then((result) => {
        // Reload the page only after the user clicks the OK button
        if (result.isConfirmed) {
            location.reload();
        }
    });
    return; // Exit the function
}

if (email === '') {
    // Display an error message using Sweet Alert
    Swal.fire({
        title: 'Cannot Update',
        text: 'Email cannot be empty.',
        icon: 'error',
        // Add a confirm button to the SweetAlert dialog
        showConfirmButton: true
    }).then((result) => {
        // Reload the page only after the user clicks the OK button
        if (result.isConfirmed) {
            location.reload();
        }
    });
    return; // Exit the function
}

    // Check if any of the values have changed
    if (firstname === originalFirstname && 
        lastname === originalLastname &&
        role === originalRole &&
        email === originalEmail) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Cannot Update',
            text: 'You must make changes before updating your profile.',
            icon: 'info'
        });
        return; // Exit the function
    }

    // Check if the new email is already in use
    if (email !== originalEmail) {
        // Send a request to the server to check if the email is unique
        fetch('/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token header
            },
            body: JSON.stringify({
                emaill: email
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.unique) {
                // Display an error message using Sweet Alert
                Swal.fire({
                    title: 'Cannot Update',
                    text: 'The email is already in use.',
                    icon: 'error'
                });
            } else {
                // Proceed with updating the profile
                sendUpdateRequest(firstname, lastname, role, email);
            }
        })
        .catch(error => {
            // Display an error message using Sweet Alert
            Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again later.',
                icon: 'error'
            });
        });
    } else {
        // Proceed with updating the profile
        sendUpdateRequest(firstname, lastname, role, email);
    }
}

function sendUpdateRequest(firstname, lastname, role, email) {
    // Send the updated data to the server using AJAX
    fetch('/update-profile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token header
        },
        body: JSON.stringify({
            firstname: firstname,
            lastname: lastname,
            role: role,
            email: email
        })
    })
    .then(response => {
        // Check if the update was successful
        if (response.ok) {
            // Display a success message using Sweet Alert
            Swal.fire({
                title: 'Success!',
                text: 'Your profile has been updated successfully.',
                icon: 'success'
            }).then(() => {
                // Optionally, reload the page or perform other actions
                location.reload(); // Reload the page after successful update
            });
        } else {
            // Display an error message using Sweet Alert
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update your profile. Please try again later.',
                icon: 'error'
            });
        }
    })
    .catch(error => {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again later.',
            icon: 'error'
        });
    });
}

function togglePasswordVisibility(fieldId) {
    var field = document.getElementById(fieldId);
    var toggleIcon = document.getElementById(fieldId + 'Toggle');

    if (field.type === "password") {
        field.type = "text";
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        field.type = "password";
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function confirmUpdatePass() {
    // Get the values from the form fields
    var currentPassword = document.getElementById('currentpasswordd').value;
    var newPassword = document.getElementById('newpasswordd').value;
    var confirmPassword = document.getElementById('confirmpasswordd').value;

    // Regular expression for validating the password format
    var passwordRegex = /^(?=.*[a-zA-Z0-9!@#$%^&*]).{8,}$/;
    
    // Check if any of the fields are empty
    if (!currentPassword || !newPassword || !confirmPassword) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'Please fill in all the fields for changing password.',
            icon: 'error'
        });
        return; // Exit the function
    }

    // Check if the current password is not empty
    if (!currentPassword) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'Please enter your current password.',
            icon: 'error'
        });
        return; // Exit the function
    }

    // Validate current password length
    if (currentPassword.length < 8) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'Remember your current password is at least 8 characters long!',
            icon: 'error'
        });
        return; // Exit the function
    }

    // Check if the new password and confirm password match
    if (newPassword !== confirmPassword) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'New password and confirm password do not match.',
            icon: 'error'
        });
        return; // Exit the function
    }

     // Check if the new password is the same as the current password
     if (newPassword === currentPassword) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'New password must be different from the current password.',
            icon: 'error'
        });
        return; // Exit the function
    }

    // Check if the new password meets the format requirements
    if (!passwordRegex.test(newPassword)) {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'New password must contain at least one letter, one number, or one symbol and be at least 8 characters long.',
            icon: 'error'
        });
        return; // Exit the function
    }

    // Display SweetAlert confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to update your password?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        // If user confirms, proceed with update
        if (result.isConfirmed) {
            // Call the function to update the password
            updatePassword();
        }
    });
}

// JavaScript function for changing password
function updatePassword() {
    // Get the values from the form fields
    var currentPassword = document.getElementById('currentpasswordd').value;
    var newPassword = document.getElementById('newpasswordd').value;
    var confirmPassword = document.getElementById('confirmpasswordd').value;

    // Send the data to the server using AJAX
    fetch('/change-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token header
        },
        body: JSON.stringify({
            currentPassword: currentPassword,
            newPassword: newPassword,
            confirmPassword: confirmPassword
        })
    })
    .then(response => {
        // Check if the password change was successful
        if (response.ok) {
            // Display a success message using Sweet Alert
            Swal.fire({
                title: 'Success!',
                text: 'Your password has been changed successfully.',
                icon: 'success'
            }).then(() => {
                // Optionally, reload the page or perform other actions
                location.reload(); // Reload the page after successful password change
            });
        } else {
            // Handle different error cases
            response.json().then(data => {
                // Check if the error message indicates incorrect current password
                if (data.message === 'Current password is incorrect') {
                    // Display an error message using Sweet Alert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Current password is incorrect.',
                        icon: 'error'
                    });
                } else {
                    // Display a generic error message using Sweet Alert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to change your password. Please try again later.',
                        icon: 'error'
                    });
                }
            });
        }
    })
    .catch(error => {
        // Display an error message using Sweet Alert
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again later.',
            icon: 'error'
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const profilePictureInput = document.getElementById('profilePictureInput');
    const profilePicturePreview = document.getElementById('profilePicturePreview');
    const deletePhotoBtn = document.getElementById('deletePhotoBtn');

    
    // Event listener for file input change
    profilePictureInput.addEventListener('change', function() {
        const file = profilePictureInput.files[0];
        if (file) {
            const allowedExtensions = ['jpeg', 'png', 'jpg', 'jfif', 'gif', 'svg'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (allowedExtensions.includes(fileExtension)) {
                showConfirmationDialog();
            } else {
                // Display SweetAlert message for invalid file extension
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Only JPEG, PNG, JPG, JFIF, GIF, and SVG files are allowed.',
                });
                // Clear the file input
                profilePictureInput.value = '';
            }
        }
    });

    // Event listener for "Enter" key press on file input
    profilePictureInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            const file = profilePictureInput.files[0];
            if (file) {
                const allowedExtensions = ['jpeg', 'png', 'jpg', 'jfif', 'gif', 'svg'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (allowedExtensions.includes(fileExtension)) {
                    showConfirmationDialog();
                } else {
                    // Display SweetAlert message for invalid file extension
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Only JPEG, PNG, JPG, JFIF, GIF, and SVG files are allowed.',
                    });
                    // Clear the file input
                    profilePictureInput.value = '';
                }
            }
        }
    });

    // Event listener for delete photo button
    deletePhotoBtn.addEventListener('click', function() {
        deletePhoto();
    });

    // Function to display SweetAlert confirmation dialog
    function showConfirmationDialog() {
        const file = profilePictureInput.files[0];
        if (file) {
            Swal.fire({
                title: 'Set this photo as your profile picture?',
                text: 'Are you sure you want to set this photo as your profile picture?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    uploadPhoto(file);
                }
            });
        }
    }

    function uploadPhoto(file) {
        const formData = new FormData();
        formData.append('profile_picture', file);

        fetch(`/admin/uploadPhoto`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Use the CSRF token value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Upload Successful',
                    text: 'Profile photo has been updated.',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reload the page
                        location.reload();
                    }
                });
                // Update profile picture preview
                //profilePicturePreview.src = URL.createObjectURL(file);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        });
    }
});

    // Function to delete the current profile photo
    function deletePhoto() {
        Swal.fire({
            title: 'Delete Photo',
            text: 'Are you sure you want to delete your profile photo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request to delete the profile photo
                fetch('/admin/deletePhoto', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                         // Update profile picture preview to default image
                         profilePicturePreview.src = '{{ asset("images/Defaultprofile-modified.png") }}';
                        Swal.fire({
                            icon: 'success',
                            title: 'Photo Deleted',
                            text: 'Your profile photo has been deleted.',
                            showCancelButton: true,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload the page
                                location.reload();
                            }
                        });  
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                });
            }
        });
    }
	</script>

</body>
</html>

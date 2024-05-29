<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/AdminLogin.css')}}">
    <!-- bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- fontawesome, boxicons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <form action="{{ route('admin.login.submit') }}" method="POST" class="form-container">
        @csrf
        <div class="logo">
            <img src="{{asset('images/logo0.png')}}" alt="logo" class="logo-img">
        </div>
        <header>LOGIN</header>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" id="email" name="email" required placeholder="Email" class="hover-input form-control" value="{{ old('email') ?? session('remember_email') }}" required>

        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" id="password" required placeholder="Password"
                class="hover-input form-control" required>
            <div class="pass">
                <button class="btn btn-outline-tertiary toggle-password" type="button">
                    <i class="far fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-3 form-check remember-checkbox">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>


        <div class="input-group mb-3">
        <a href="#" class="forgot-password" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password</a>
        </div>

        <div class="buttons">
            <button id="submitbtn" type="button" name="submit" class="submit">
                <span type="submit" class="submitbtn">LOGIN</span>
            </button>
        </div>

        <div>
            <p><a href="{{ route('AdminRegister') }}">Not yet Registered?</a></p>
        </div>

    </form>

 <!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-3 mx-auto" style="max-width: 350px;">
                        <label for="email" class="form-label">Enter your email</label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="Your email">
                    </div>
                    <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>




    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const submitbtn = document.getElementById('submitbtn');
    const passwordInput = document.getElementById('password');

    // Listen for keydown event on the password input field
    passwordInput.addEventListener('keydown', function (event) {
        // Check if the Enter key was pressed (keyCode 13)
        if (event.keyCode === 13) {
            // Trigger a click event on the login button
            submitbtn.click();
        }
    });

    submitbtn.addEventListener('click', function (event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
       // const remember = document.getElementById('remember').checked; // Get the value of the "Remember Me" checkbox

        // Check if email or password is empty
        if (!email.trim() || !password.trim()) {
            // Show Sweet Alert for empty fields
            Swal.fire({
                title: 'Oops!',
                text: 'Please fill out all fields.',
                icon: 'info'
            });
            return; // Stop further execution
        }

        // Make an AJAX request to authenticate the user
        fetch('{{ route("admin.login.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(response => {
            if (response.ok) {
                // If login is successful, redirect the user to the dashboard or desired page
                window.location.href = "{{ route('AdminDashboard') }}";
            } else if (response.status === 401) {
                // If login fails due to invalid email or password, display an error message
                return response.json().then(data => {
                    Swal.fire({
                        title: 'Login Failed',
                        text: data.message || 'Invalid email or password. Please try again.',
                        icon: 'error'
                    });
                });
            } else if (response.status === 404) {
                // If email is not found, display an error message
                Swal.fire({
                    title: 'Login Failed',
                    text: 'Email not found.',
                    icon: 'error'
                }); 
                } else {
                        // If login fails due to other reasons, display a generic error message
                        throw new Error('Something went wrong. Please try again later.');
                    }
                })
            .catch(error => {
                console.error('Error:', error);
                // Show error message if there's a network error or server issue
                Swal.fire({
                    title: 'Oops!',
                    text: error.message || 'Something went wrong. Please try again later.',
                    icon: 'error'
                });
            });
        });
    });

    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        // Change the icon based on the input type
        this.querySelector('i').className = type === 'password' ? 'far fa-eye' : 'far fa-eye-slash';
});

    $(document).ready(function () {
    // When the form inside the modal is submitted
    $('#forgotPasswordModal form').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission behavior
        
        // Serialize the form data
        var formData = $(this).serialize();
        
        // Hide the modal
        $('#forgotPasswordModal').modal('hide');
        
        // Send an AJAX request to the appropriate controller endpoint
        $.ajax({
            url: $(this).attr('action'), // URL specified in the form action attribute
            type: $(this).attr('method'), // HTTP method specified in the form method attribute
            data: formData, // Form data serialized
            success: function (response) {
                // Handle success response from the server
                // For example, show a success message using SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'Password reset link sent successfully!',
                    icon: 'success'
                });
            }, 
                error: function (xhr, status, error) {
                    // Handle error response from the server
                    if (xhr.status == 404) {
                        // Email not found
                        Swal.fire({
                            title: 'Email Not Found',
                            text: 'The email entered is not registered.',
                            icon: 'error'
                        });
                    }
                    else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error sending password reset link. Please try again.'
                    });
                }
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const rememberCheckbox = document.getElementById('remember');
    const emailInput = document.getElementById('email');

    // Check if the "Remember Me" checkbox is checked on page load
    if (localStorage.getItem('rememberEmail') === 'true') {
        rememberCheckbox.checked = true;
    }

    // Listen for changes to the "Remember Me" checkbox
    rememberCheckbox.addEventListener('change', function () {
        if (this.checked) {
            // If checked, store the email value in localStorage
            localStorage.setItem('rememberEmail', 'true');
            localStorage.setItem('email', emailInput.value);
        } else {
            // If unchecked, remove the email value from localStorage
            localStorage.removeItem('rememberEmail');
            localStorage.removeItem('email');
        }
    });

    // Check if email value is already stored in localStorage
    if (localStorage.getItem('email')) {
        // If email is stored, populate the email input field
        emailInput.value = localStorage.getItem('email');
    }

    // Listen for changes to the email input field
    emailInput.addEventListener('input', function () {
        if (rememberCheckbox.checked) {
            // If checkbox is checked, update the email value in localStorage
            localStorage.setItem('email', this.value);
        }
    });

    // Clear localStorage when the form is submitted
    document.querySelector('form').addEventListener('submit', function () {
        localStorage.removeItem('rememberEmail');
        localStorage.removeItem('email');
    });
});

</script>

</body>
</html>
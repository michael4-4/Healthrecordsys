<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/UserRegister.css')}}">
    <!-- bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- fontawesome, boxicons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
    <form method="POST" action="{{ route('user.register.submit') }}" class="form-container">
        @csrf
        <div class="logo">
            <img src="{{asset('images/logo0.png')}}" alt="logo" class="logo-img">
        </div>

        <header>REGISTER ACCOUNT</header>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="firstName">First Name<span style="color: red"> *</span></label>
                    <input type="text" name="firstname" id="firstname" required placeholder="First name"
                        class="hover-input form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="lastName">Last Name<span style="color: red"> *</span></label>
                    <input type="text" name="lastname" id="lastname" required placeholder="Last name"
                        class="hover-input form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="position">Position<span style="color: red"> *</span></label>
            <select id="position" name="position" required>
                <option disabled selected>Select</option>
                <option value="MHO">MHO</option>
                <option value="Nurse">Nurse</option>
                <option value="Midwife">Midwife</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email<span style="color: red"> *</span></label>
            <input type="email" name="email" id="email" required placeholder="Enter your email"
                class="hover-input form-control">
        </div>
        
                <!-- Inside your HTML form -->
        <div class="form-group">
            <label for="password">Password<span style="color: red"> *</span></label>
            <input type="password" name="password" id="password" required placeholder="Must have at least 8 characters" class="hover-input form-control">
            <!-- Indicator for password strength -->
            <div class=toggle-password>
            <button class="btn btn-outline-tertiary toggle-password pass" type="button" >
                <i class="far fa-eye"></i>
            </button>
            </div>
            <div id="password-strength" class="password-strength-indicator"></div>
        </div>

        <div class="form-group">
    <label for="confirmPassword">Confirm Password<span style="color: red"> *</span></label>
    <input type="password" name="password_confirmation" id="confirmPassword" required placeholder="Confirm your password" class="hover-input form-control">
    <div class="input-group-append">
        <button class="btn btn-outline-tertiary toggle-password-confirm" type="button">
            <i class="far fa-eye"></i>
        </button>        
    </div>
    <div id="passwordMatchMessage"  class="passwordMatchMessage-indicator"></div>
</div>
    

        <div class="buttons">
            <button id="submitbtn" type="submit" name="submit" class="submit">
                <span type="submit" class="submitbtn">REGISTER</span>
            </button>
        </div>
        
        <div>
            <p><a href="{{ route('UserLogin') }}">Login Here ></a></p>
        </div>
    </form>


<script>
    // JavaScript to toggle password visibility for confirm password field
    const togglePasswordConfirm = document.querySelector('.toggle-password-confirm');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        // Change the icon based on the input type
        this.querySelector('i').className = type === 'password' ? 'far fa-eye' : 'far fa-eye-slash';
    });


    const togglePassword = document.querySelectorAll('.toggle-password');

        togglePassword.forEach((button) => {
            button.addEventListener('click', function () {
                const inputField = this.previousElementSibling;
                const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', type);
                // Change the icon based on the input type
                this.querySelector('i').className = type === 'password' ? 'far fa-eye' : 'far fa-eye-slash';
            });
        });

        function checkPasswordStrength(password, confirmPassword) {
        const strengthIndicator = document.querySelector('#password-strength');
        const weakColor = "#FF6347";     // Red color for weak passwords
        const mediumColor = "#FFA500";   // Orange color for medium passwords
        const strongColor = "#2E8B57";   // Green color for strong passwords

        let strength = 0;
        let borderColor = "";

        // Check for lowercase letters
        if (password.match(/[a-z]/)) {
            strength++;
        }

        // Check for uppercase letters
        if (password.match(/[A-Z]/)) {
            strength++;
        }

        // Check for numbers
        if (password.match(/[0-9]/)) {
            strength++;
        }

        // Check for symbols
        if (password.match(/[!@#$%^&*()_+{}[\]:;<>,.?~\\/-]/)) {
            strength++;
        }

        if (strength === 0) {
            strengthIndicator.textContent = "";
            strengthIndicator.style.color = ""; // Reset color
            borderColor = ""; // Reset border color
        } else if (strength <= 2) {
            strengthIndicator.textContent = "Weak";
            strengthIndicator.style.color = weakColor;
            borderColor = weakColor;
        } else if (strength === 3) {
            strengthIndicator.textContent = "Medium";
            strengthIndicator.style.color = mediumColor;
            borderColor = mediumColor;
        } else if (strength >= 4) {
            strengthIndicator.textContent = "Strong";
            strengthIndicator.style.color = strongColor;
            borderColor = strongColor;
        }

        // Set border color for password and confirm password fields
        document.querySelector('#password').style.borderColor = borderColor;
        document.querySelector('#confirmPassword').style.borderColor = borderColor;

        
    // Check password match
    checkPasswordMatch(password, confirmPassword);
}

    // Attach input event listener to password field for password strength checking
    document.querySelector('#password').addEventListener('input', function () {
        const password = this.value;
        const confirmPassword = document.querySelector('#confirmPassword').value;
        checkPasswordStrength(password, confirmPassword);
    });

    // Attach input event listener to confirm password field for password strength checking
    document.querySelector('#confirmPassword').addEventListener('input', function () {
        const confirmPassword = this.value;
        const password = document.querySelector('#password').value;
        checkPasswordStrength(password, confirmPassword);
    });

    function checkPasswordMatch(password, confirmPassword) {
    const passwordMatchMessage = document.querySelector('#passwordMatchMessage');
    const passwordField = document.querySelector('#password');
    const confirmPasswordField = document.querySelector('#confirmPassword');

    if (password === "" && confirmPassword === "") {
        // Reset the message and remove any glow effect
        passwordField.classList.remove('match', 'not-match');
        confirmPasswordField.classList.remove('match', 'not-match');
        document.querySelector('#passwordMatchMessage').textContent = ""; // Reset the message
    } else if (password === confirmPassword) {
        // Passwords match, apply green glow and update message
        passwordField.classList.add('match');
        confirmPasswordField.classList.add('match');
        passwordField.classList.remove('not-match');
        confirmPasswordField.classList.remove('not-match');
        document.querySelector('#passwordMatchMessage').textContent = "Passwords match";
        document.querySelector('#passwordMatchMessage').style.color = "#2E8B57"; // Green color for match
    } else {
        // Passwords do not match, apply red glow and update message
        passwordField.classList.add('not-match');
        confirmPasswordField.classList.add('not-match');
        passwordField.classList.remove('match');
        confirmPasswordField.classList.remove('match');
        document.querySelector('#passwordMatchMessage').textContent = "Passwords do not match";
        document.querySelector('#passwordMatchMessage').style.color = "#FF6347"; // Red color for mismatch
    }
}

    // Initial check for password match
    checkPasswordMatch(document.querySelector('#password').value, document.querySelector('#confirmPassword').value);

    document.addEventListener('DOMContentLoaded', function() {
    const submitbtn = document.getElementById('submitbtn');

    // Function to handle register button click
    function handleRegisterButtonClick(event) {
        event.preventDefault(); // Prevent the default form submission

        // Check if any required fields are empty
        const requiredFields = document.querySelectorAll('input[required]');
        let allFieldsFilled = true;
        requiredFields.forEach(field => {
            if (field.value.trim() === '') {
                allFieldsFilled = false;
            }
        });

        if (!allFieldsFilled) {
            // If any required field is empty, show an alert
            Swal.fire({
                title: 'Oops!',
                text: 'Please fill in all required fields before registering.',
                icon: 'info'
            });
            return; // Stop further execution
        }

        // Check if passwords match
        const password = document.querySelector('#password').value;
        const confirmPassword = document.querySelector('#confirmPassword').value;
        if (password !== confirmPassword) {
            // Passwords do not match, display an alert
            Swal.fire({
                title: 'Oops!',
                text: 'Passwords do not match.',
                icon: 'error'
            });
            return; // Stop further execution
        }

        // Check if password length is less than 8 characters
        if (password.length < 8) {
            // Password length is less than 8 characters, display an alert
            Swal.fire({
                title: 'Oops!',
                text: 'Password must be at least 8 characters long.',
                icon: 'error'
            });
            return; // Stop further execution
        }

        // Check if the email is already taken
        const email = document.querySelector('#email').value;
        fetch('{{ route("user.check_email") }}?email=' + email)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    // Email is already taken, show an alert
                    Swal.fire({
                        title: 'Oops!',
                        text: 'This email is already in use. Please try another one.',
                        icon: 'error'
                    });
                } else {
                    // Email is available, proceed with registration
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to register this account?',
                        html: 'Are you sure you want to submit this registration?<br>Please review before proceeding',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, register!',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        // If user confirms registration, submit the form data using AJAX
                        if (result.isConfirmed) {
                            const formData = new FormData(document.querySelector('.form-container'));

                            // Send the form data to the server using AJAX
                            fetch('{{ route("user.register.submit") }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => {
                                if (response.ok) {
                                    // Registration successful, show success message
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Registration successful.',
                                        icon: 'success'
                                    }).then(() => {
                                        // Redirect to UserLogin route after clicking OK
                                        window.location.href = "{{ route('UserLogin') }}";
                                    });
                                } else {
                                    // Registration failed, show error message
                                    Swal.fire({
                                        title: 'Oops!',
                                        text: 'Something went wrong. Please try again later.',
                                        icon: 'error'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                // Show error message
                                Swal.fire({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'error'
                                });
                            });
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message
                Swal.fire({
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again later.',
                    icon: 'error'
                });
            });
    }

    // Attach click event listener to the register button
    document.querySelector('#submitbtn').addEventListener('click', handleRegisterButtonClick);
});




</script>

</body>
</html>
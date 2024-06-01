<script>
    import { onMount } from "svelte";
    import { router, useForm } from "@inertiajs/svelte";
    import {
        FormGroup,
        Input,
        Button,
        InputGroup,
        InputGroupText,
    } from "@sveltestrap/sveltestrap";
    import Swal from "sweetalert2";
    import { SyncLoader } from "svelte-loading-spinners";

    export let passwordEmailUrl = "";
    export let registerUrl = "/auth/register";
    export let dashboardUrl = "/dashboard";
    let isVisible = false;
    let email = "";
    let password = "";
    let remember = false;
    let isLoading = false;

    let form = useForm({
        email: null,
        password: null,
    });

    function delay(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    function waitUntil(condition, timeout = 30000, pollInterval = 100) {
        return new Promise((resolve, reject) => {
            const startTime = Date.now();
            const checkCondition = () => {
                if (condition()) {
                    resolve(true);
                    return;
                }
                if (Date.now() - startTime >= timeout) {
                    resolve(false);
                    return;
                }
                setTimeout(checkCondition, pollInterval);
            };
            checkCondition();
        });
    }

    onMount(() => {
        if (localStorage.getItem("rememberEmail") === "true") {
            remember = true;
            email = localStorage.getItem("email");
        }
    });

    const togglePasswordVisibility = () => {
        isVisible = !isVisible;
        const passwordInput = document.getElementById("password");
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);
    };

    const handleSubmit = async () => {
        if (!email.trim() || !password.trim()) {
            Swal.fire({
                title: "Oops!",
                text: "Please fill out all fields.",
                icon: "info",
            });
            return;
        }

        isLoading = true;
        await delay(2000);

        try {
            const response = await fetch("/api/authAPI/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                }),
            });

            // console.log(await response.body.getReader().read());

            if (!response.ok) {
                const data = await response.json();
                throw new Error(
                    data.message ||
                    "Invalid email or password. Please try again."
                );
            }else{
                // router.visit("/dashboard", { replace: true });
            }

        } catch (error) {
            console.log(error);
            Swal.fire({
                title: "Oops!",
                text:
                    "Something went wrong. Please try again later.",
                icon: "error",
            });
        }

        isLoading = false;
    };

    const handleRememberMe = () => {
        if (remember) {
            localStorage.setItem("rememberEmail", "true");
            localStorage.setItem("email", email);
        } else {
            localStorage.removeItem("rememberEmail");
            localStorage.removeItem("email");
        }
    };

    const handleForgotPassword = async (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);

        try {
            const response = await fetch(passwordEmailUrl, {
                method: "POST",
                body: formData,
            });

            if (response.ok) {
                Swal.fire({
                    title: "Success!",
                    text: "Password reset link sent successfully!",
                    icon: "success",
                });
            } else if (response.status === 404) {
                Swal.fire({
                    title: "Email Not Found",
                    text: "The email entered is not registered.",
                    icon: "error",
                });
            } else {
                throw new Error(
                    "Error sending password reset link. Please try again."
                );
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:
                    error.message ||
                    "Error sending password reset link. Please try again.",
            });
        }
    };
</script>

<div class="w-screen h-screen bg-white">
    <form on:submit|preventDefault={handleSubmit} class="form-container">
        <div class="logo">
            <img src="/images/logo0.png" alt="logo" class="logo-img" />
        </div>

        {#if !isLoading}
            <header>LOGIN</header>

            <div class="mx-auto w-80">
                <FormGroup label="Email" floating>
                    <Input name="email" id="email" bind:value={email}></Input>
                </FormGroup>
                <InputGroup style="height:58px !important">
                    <FormGroup label="Password" floating>
                        <Input
                            name="password"
                            id="password"
                            bind:value={password}
                            type="password"
                        ></Input>
                    </FormGroup>
                    <InputGroupText
                        class="my-0 p-0 border-0 shadow-none"
                        style="height:58px !important"
                    >
                        <Button
                            type="button"
                            on:click={togglePasswordVisibility}
                            class="w-full h-full bg-white"
                        >{#if !isVisible}
                            <i class="bx bxs-bullseye"></i>
                            {:else}
                                <i class="bx bx-low-vision"></i>
                            {/if}</Button
                        >
                    </InputGroupText>
                </InputGroup>

                <div class="d-flex justify-content-center mt-3">
                    <Input
                        class="w-32"
                        id="remember"
                        bind:checked={remember}
                        on:change={handleRememberMe}
                        type="checkbox"
                        label="Remember me"
                    ></Input>
                </div>
            </div>

            <Button
                color="link"
                class="border-0 shadow-none mt-5"
                style="color: #036c5f"
                outline>Forgot Password</Button
            >

            <div class="w-full">
                <button
                    id="submitbtn"
                    type="submit"
                    class="submit"
                >
                    <span class="submitbtn">LOGIN</span>
                </button>
            </div>

            <div>
                <p><a href={registerUrl}>Not yet Registered?</a></p>
            </div>
        {:else}
            <header>Logging in please wait</header>
            <div class="d-flex justify-content-center">
                <SyncLoader color="#036c5f"></SyncLoader>
            </div>
        {/if}
    </form>


    <!-- Forgot Password Modal -->
    <div
        class="modal fade"
        id="forgotPasswordModal"
        tabindex="-1"
        aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">
                        Forgot Password
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body text-center">
                    <form
                        action={passwordEmailUrl}
                        method="POST"
                        on:submit={handleForgotPassword}
                    >
                        @csrf
                        <div class="mb-3 mx-auto" style="max-width: 350px;">
                            <label for="email" class="form-label"
                                >Enter your email</label
                            >
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                required
                                placeholder="Your email"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary"
                            >Email Password Reset Link</button
                        >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .logo-img {
        width: 23%;
        height: 18%;
    }

    .form-container {
        width: 100%;
        text-align: center;
        position: fixed; /* or absolute */
        top: 50%; /* adjust as needed */
        left: 50%; /* adjust as needed */
        transform: translate(-50%, -50%); /* center the form */
        z-index: 1; /* Ensure the form stays on top */
    }

    .form-container header {
        margin-top: 10px;
        margin-bottom: 30px;
        font-size: 25px;
        font-weight: 600;
        color: #000000;
        text-align: center;
    }
    .hover-input:hover {
        border: 1px solid #036c5f;
        box-shadow: 0 0 2px rgba(0, 123, 255, 3);
        outline: none !important;
    }

    .input-group {
        margin-bottom: 20px;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group-text {
        color: #000000;
        height: 38px;
        display: flex;
        align-items: center;
        background-color: #e7e7e7;
        border: 1px solid #aaa;
        border-radius: 6px 0 0 6px;
        padding: 8px;
    }

    .form-control {
        outline: none;
        font-size: 13px;
        font-weight: 400;
        color: #333;
        border-radius: 0 6px 6px 0;
        border: 2px solid #aaa;
        padding: 8px;
        width: 100%;
        max-width: 350px;
        flex: 1;
        transition:
            border-color 0.3s,
            box-shadow 0.3s;
    }

    .form-control:hover {
        border-color: #036c5f;
        box-shadow: 0 3px 6px rgba(19, 129, 91, 0.1);
    }

    .form-control:active,
    .form-control:focus {
        border-color: #036c5f !important;
        box-shadow: 0 3px 6px rgba(16, 137, 77, 0.13);
        outline: none !important;
    }

    .forgot-password {
        margin-top: 8px;
        text-align: right;
        font-size: 14px;
    }

    .buttons {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    button {
        padding: 8px 95px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit {
        background-color: #036c5f;
        color: white;
        border-radius: 6px;
    }

    .submit:hover {
        background-color: #24a090;
    }

    .input-group a {
        margin-top: 18px; /* in adjust ko */
        text-align: right;
        font-size: 14px;
        text-decoration: underline;
        color: #036c5f;
        transition: color 0.3s;
    }

    .input-group a:hover {
        color: #2840a9;
    }

    .form-container p {
        margin-top: 30px;
        text-align: center;
        font-size: 14px;
    }

    .form-container p a {
        text-decoration: underline;
        color: #036c5f;
    }

    .form-container p a:hover {
        color: #2840a9;
        text-decoration: underline;
    }

    .input-group-text .fas.fa-envelope {
        color: #036c5f;
    }

    .input-group-text .fas.fa-lock {
        color: #036c5f;
    }

    .pass {
        position: absolute;
        top: 61px;
        transform: translateY(-161%);
        right: 491px; /* Adjust as needed */
        cursor: pointer;
    }

    /* Style for the checkbox itself */
    .remember-checkbox {
        position: absolute;
        right: 36%;
        top: 55%;
        transform: translateY(162%);
        font-size: 0.91rem;
    }

    .remember-checkbox input[type="checkbox"] {
        border: 1px solid grey; /* Add a grey border to the checkbox */
    }

    .modal-title {
        text-align: center !important;
    }
</style>

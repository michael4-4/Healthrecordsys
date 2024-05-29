<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Auth\Passwords\PasswordBroker;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

    // Check if the email exists in the admins table
    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        // Email not found in the admins table
        return response()->json(['success' => false, 'message' => 'Email not found.'], 404);
    }

    // Email found, send the reset link
    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    return $response == \Illuminate\Auth\Passwords\PasswordBroker::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($response)
                : $this->sendResetLinkFailedResponse($request, $response);
}

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}

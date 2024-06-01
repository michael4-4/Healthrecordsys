<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as BuiltInAuth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class Auth extends Controller
{
    public function index()
    {
        return Inertia::render('auth/index');
    }

    public function getRegister()
    {
        return Inertia::render('auth/register');
    }



}

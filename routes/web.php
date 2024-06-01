<?php

use Illuminate\Support\Facades\Route;
use Buki\AutoRoute\Facades\Route as AutoRoute;
//Inertia
use Inertia\Inertia;

// Admin use
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminManageAccountsController;
use App\Http\Controllers\AdminViewAccountsController;
use App\Http\Controllers\AdminViewRecordsController;
use App\Http\Controllers\AdminViewTreatmentRecordsController;
// for download
use App\Http\Controllers\AdminDownloadPatientInfoController;

// Users use
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;

// for adding records
use App\Http\Controllers\AddPatientRecordController;

// for viewing records + view patientinfo editpatientinfo
use App\Http\Controllers\ViewRecordsController;

// for download
use App\Http\Controllers\DownloadPatientInfoController;
use App\Http\Controllers\DownloadViewRecordsController;

// for adding patient treatment record
use App\Http\Controllers\AddPatientTreatmentController;
use App\Http\Controllers\HomeController;
// for viewing patient treatment record
use App\Http\Controllers\ViewTreatmentRecordsController;

// Route::get('/', function () {
//     return view('welcome');
// });



AutoRoute::auto("/patients/","Patients");
AutoRoute::auto("/user","User");
AutoRoute::auto("/admin","Admin");
AutoRoute::auto("/treatments","Treatments");
AutoRoute::auto("/","HomeController");
AutoRoute::auto("/auth/","Auth");
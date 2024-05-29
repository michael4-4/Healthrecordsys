<?php

use Illuminate\Support\Facades\Route;
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

// for viewing patient treatment record
use App\Http\Controllers\ViewTreatmentRecordsController;

Route::get('/', function () {
    return view('welcome');
});

//ALL for ADMIN

// Register route
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register.submit');
Route::get('/admin/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('AdminRegister');

// Add a route in your routes/web.php file
// Email checker route
Route::get('/admin/check-email', [AdminRegisterController::class, 'checkEmail'])->name('admin.check_email');

Route::get('/admin/dashboard', function () {
    // Your dashboard logic goes here
})->middleware('role:admin');

//Login route
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('AdminLogin');

//Route::post('/admin/login', 'AdminLoginController@login')->name('admin.login.submit'); // this works

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // modal
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset'); // reset page
Route::post('reset-password', [ResetPasswordController::class, 'reset']);

// Dashboard route
Route::get('/admin/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('AdminDashboard');

// Logout
Route::post('/adminlogout', [AdminLoginController::class, 'adminlogout'])->name('adminlogout');

// Route for showing admin profile
Route::get('/admin/profile', [AdminProfileController::class, 'showProfileForm'])->name('AdminProfile');

// Route for edit profile
Route::post('/update-profile', [AdminProfileController::class, 'updateProfile'])->name('updateProfile');

// Route for check email
Route::post('/check-email', [AdminProfileController::class, 'checkEmail'])->name('checkEmail');

// Route for password change
Route::post('/change-password', [AdminProfileController::class, 'updatePassword'])->name('updatePassword');

// Route for uploading photo
Route::post('/admin/{id}/uploadPhoto', [AdminProfileController::class, 'uploadPhoto'])->name('uploadPhoto');
Route::post('/admin/uploadPhoto', [AdminProfileController::class, 'uploadPhoto'])->name('uploadPhoto');

// Route for deleting photo
Route::post('/admin/deletePhoto', [AdminProfileController::class, 'deletePhoto'])->name('deletePhoto');

// Route for showing manage account
Route::get('/admin/manage_accounts', [AdminManageAccountsController::class, 'showManageAccountsForm'])->name('AdminManageAccounts');

// Route for showing manage account
Route::get('/admin/view_accounts/{id}', [AdminViewAccountsController::class, 'showViewAccountsForm'])->name('AdminViewAccounts');

// Define the route for deleting accounts
Route::delete('/admin/delete_accounts/{id}', [AdminManageAccountsController::class, 'deleteAccount'])->name('AdminDeleteAccounts');

// Route for showing patient records for viewing
Route::get('/admin/view_records', [AdminViewRecordsController::class, 'showViewRecordsForm'])->name('AdminViewRecords');

// Route for showing patient records and to delete records
Route::delete('/admin/delete_records/{id}', [AdminViewRecordsController::class, 'deleteRecord'])->name('AdminDeleteRecords');

// Route to view an individual patient enrolment record
Route::get('admin/patient/{id}', [AdminViewRecordsController::class, 'view'])->name('AdminViewPatientInfo');

// Route to view an individual treatment record
Route::get('admin/patient_treatment_record/{id}/{treatment_id}', [AdminViewTreatmentRecordsController::class, 'view'])->name('AdminViewTreatmentRecords');

// Define the route for deleting treatment record
Route::delete('/admin/delete_treatment_record/{id}/{treatment_id}', [AdminViewTreatmentRecordsController::class, 'deleteTreatmentRecord'])->name('AdminDeleteTreatmentRecords');

// Route to Download patient info for admin
Route::get('/patient/{id}/download-pdf', [AdminDownloadPatientInfoController::class, 'downloadPatientInfoPdf'])->name('patient.download.pdf');

// Route to Download treatment records for admin
Route::get('/patient_treatment_record/{id}/{treatment_id}/download-pdf', [AdminDownloadPatientInfoController::class, 'downloadTreatmentRecordPdf'])->name('treatment.download.pdf');



// Dashboard to get admin name, image,
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');

//ALL for USERS

// Register route
Route::post('/register', [UserRegisterController::class, 'register'])->name('user.register.submit');
Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('UserRegister');

// Email checker route
Route::get('/check-email', [UserRegisterController::class, 'checkEmail'])->name('user.check_email');

//Login route
Route::post('/login', [UserLoginController::class, 'login'])->name('user.login.submit');
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('UserLogin');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('Dashboard');

// Logout
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');

// Route for showing admin profile
Route::get('/user/profile', [UserProfileController::class, 'showProfileForm'])->name('UserProfile');

// Route for edit profile
Route::post('/user/update-profile', [UserProfileController::class, 'updateProfile'])->name('updateProfile');

// Route for check email
Route::post('/user/check-email', [UserProfileController::class, 'checkEmail'])->name('checkEmail');

// Route for password change
Route::post('/user/change-password', [UserProfileController::class, 'updatePassword'])->name('updatePassword');

// Route for uploading photo
Route::post('/user/{id}/uploadPhoto', [UserProfileController::class, 'uploadPhoto'])->name('uploadPhoto');
Route::post('/user/uploadPhoto', [UserProfileController::class, 'uploadPhoto'])->name('uploadPhoto');

// Route for deleting photo
Route::post('/user/deletePhoto', [UserProfileController::class, 'deletePhoto'])->name('deletePhoto');

// Add Patient Record
Route::get('/add_patient_record', [AddPatientRecordController::class, 'showAddPatientRecordForm'])->name('AddPatientRecord');
Route::post('/patient-enrolment/store', [AddPatientRecordController::class, 'store'])->name('patient-enrolment.store');

// View Record
Route::get('/view_records', [ViewRecordsController::class, 'showViewRecordsForm'])->name('ViewRecords');

// Route to view an individual patient record
Route::get('/patient/{id}', [ViewRecordsController::class, 'view'])->name('patient.view');

// Route to edit an individual patient record
Route::get('/patient/{id}/edit', [ViewRecordsController::class, 'edit'])->name('patient.edit');

// Route to Download 
Route::get('/patient/{id}/download-pdf', [DownloadPatientInfoController::class, 'downloadPatientInfoPdf'])->name('patient.download.pdf');

// Update patient information
Route::post('/patient/{id}/update', [ViewRecordsController::class, 'update'])->name('patient.update');

// Add Treatment
Route::get('/add_patient_treatment/{id}', [AddPatientTreatmentController::class, 'showAddPatientTreatmentForm'])->name('AddPatientTreatment');
Route::post('/patient-treatment/store', [AddPatientTreatmentController::class, 'store'])->name('patient-treatment.store');

// Define routes for viewing and editing treatment records

//Route::get('/patient_treatment_record/{id}/{treatment_id}', [ViewTreatmentRecordController:: class, 'view'])->name('treatment.view');


Route::get('/patient_treatment_record/{id}/{treatment_id}', [ViewTreatmentRecordsController::class, 'view'])->name('treatment.view');
Route::get('/patient_treatment_record/{id}/{treatment_id}/edit', [ViewTreatmentRecordsController::class, 'edit'])->name('treatment.edit');

// Update patient information
Route::post('/patient_treatment_record/{id}/{treatment_id}/update', [ViewTreatmentRecordsController::class, 'updateTreatment'])->name('treatment.update');


// Route to Download treatment records
Route::get('/patient_treatment_record/{id}/{treatment_id}/download-pdf', [DownloadPatientInfoController::class, 'downloadTreatmentRecordPdf'])->name('treatment.download.pdf');


Route::get('/download-view-records-pdf', [DownloadViewRecordsController::class, 'downloadViewRecordsPdf'])->name('download.view.records.pdf');

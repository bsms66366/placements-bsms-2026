<?php
use App\Enums\ServerStatus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\PathPotController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserLevelController;
use App\Http\Controllers\SpottersController;
use App\Http\Controllers\DicomViewerController;
use App\Http\Controllers\Auth\PasswordResetController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\NovaResetPasswordController;

use App\Models\GPTeacher;
use App\Models\Placement;
use App\Models\Video;
use App\Models\Dissection;
use App\Models\PlacementList;
use App\Models\Workshops;
use App\Models\Location;
use App\Models\Student;
use App\Models\User;
use App\Models\Spotters;
use App\Nova\Category;
use App\Nova\Notes;
use App\Nova\PathPots;
//use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Home Route
Route::get('/', function () {
    return view('privacy');
});

// Authentication Routes
Auth::routes(['verify' => true]);

// User Routes
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/edit/{id}', [UserController::class, 'edit']);
Route::post('users/update', [UserController::class, 'update'])->name('users.update');
Route::get('users/destroy/{id}', [UserController::class, 'destroy']);

// User Levels Routes
Route::get('/users/{user}/edit', [UserLevelController::class, 'edit'])->middleware(['auth'])->name('userlevels.edit');
Route::put('/users/{user}', [UserLevelController::class, 'update'])->middleware(['auth'])->name('userlevels.update');

// Path Pots Routes
Route::resource('pathpots', PathPotController::class);

// Notes Routes
Route::get('notes', [NotesController::class, 'index']);

// Spotters Routes
Route::get('spotters', [SpottersController::class, 'index']);

// DICOM Viewer Routes
Route::get('dicom-viewer/{fileId}', [DicomViewerController::class, 'show']);
Route::get('dicom/{filename}', [DicomViewerController::class, 'download']);
Route::get('dicom', function () {
    return \App\Models\Dicom::all();
});

// PDF Routes
Route::view('/pdfView', 'pdfView');
Route::get('/pdfView', function () {
    return view('pdfView');
});

// Category Route
Route::get('/categories/{category}', function (Category $category) {
    return $category->value;
});

// API Routes
Route::get('/api/{filename}', function ($filename) {
    $path = public_path('pdf/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('/avatars/{filename}', function ($filename) {
    $path = public_path('app/public/avatars/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response()->make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

// CSRF Token Route
Route::get('/token', function () {
    return csrf_token();
});

//// Forgot and Reset Password Routes
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/reset-password', [NovaResetPasswordController::class, 'showResetForm']);





//Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');
//Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
//Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.reset');
//Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.update');

// Home Route after Authentication
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/check-mail-config', function () {
    $config = [
        'transport' => config('mail.mailers.smtp.transport'),
        'host' => config('mail.mailers.smtp.host'),
        'port' => config('mail.mailers.smtp.port'),
        'from' => config('mail.from'),
        'encryption' => config('mail.mailers.smtp.encryption'),
        'username' => config('mail.mailers.smtp.username'),
        'password' => config('mail.mailers.smtp.password'),
    ];

    dd($config);
});

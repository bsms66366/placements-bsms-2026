<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
//use APP_URL;

//use App\Http\Controllers\API\ForgotPasswordController;
//use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PathPotController;
use App\Http\Controllers\SpottersController;
use App\Http\Controllers\DicomController;

use App\Http\Controllers\PhysquizController;

use App\Http\Controllers\Auth\NovaResetPasswordController;
//use App\Http\Controllers\Auth\CodeCheckController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Enums\StatusEnums;
use App\Models\GPTeacher;
use App\Models\Placement;
use App\Models\Video;
use App\Models\Dissection;
use App\Models\Dicom;
use App\Models\PlacementList;
use App\Models\Workshops;
use App\Models\Location;
use App\Models\Student;
use App\Models\User;
use App\Models\Notes;
use App\Models\PathPots;
use App\Models\Spotters;
use App\Models\Category;
use App\Models\NiftiViewer;
use App\Models\Physquiz;
use App\Models\Biomedeng;
use App\Models\SessionAttendance2026;
use App\Models\MonitoredSessions2026;
use App\Models\Location2025;
use App\Models\LocationSignoff;
use App\Models\Examination;
use App\Models\ExaminationResult;
use App\Models\PhaseOneStaff;
use App\Models\ClinicalGroup;
use App\Models\ExternalSite;
use App\Models\AppFeedback;



//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Student login using bsms_id as password
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
        'device_name' => 'required|string',
    ]);
 
    // Try to find student by email or bsms_id with relationships
    $student = Student::with(['gp_teacher', 'facilitator', 'group', 'location2025', 'locations'])
        ->where('email', $request->email)
        ->orWhere('bsms_id', $request->email)
        ->first();
 
    // Check if student exists and password matches bsms_id
    if (!$student || $request->password !== $student->bsms_id) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    
    // Debug: Log what's loaded
    Log::info('Student loaded', [
        'id' => $student->id,
        'gp_teacher_id' => $student->gp_teacher_id,
        'gp_teacher_loaded' => $student->relationLoaded('gp_teacher'),
        'gp_teacher_value' => $student->gp_teacher,
    ]);
 
    $token = $student->createToken($request->device_name)->plainTextToken;

    // Prepare user data with relationships
    $userData = $student->only('id','name','email','bsms_id','student_number','firstname','known_as','dob','year','age','rotation_group','seminar_group','cpw','cps','cpw_cps','simulated_home_visit_group','locations_id','gp_teacher_id','gender','car_owner','notes','created_at');
    
    // Add relationship data - ensure they're properly loaded and not empty
    $userData['gp_teacher_obj'] = $student->relationLoaded('gp_teacher') && $student->gp_teacher ? $student->gp_teacher : null;
    $userData['facilitator'] = $student->relationLoaded('facilitator') && $student->facilitator ? $student->facilitator : null;
    $userData['group'] = $student->relationLoaded('group') && $student->group ? $student->group : null;
    $userData['location'] = ($student->relationLoaded('location2025') && $student->location2025) ? $student->location2025 : (($student->relationLoaded('locations') && $student->locations) ? $student->locations : null);

    return response()->json([
        'token' => $token,
        'user' => $userData,
    ], 201);
});

// Staff/Admin login using User table (keep for admin access)
Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    $token = $user->createToken($request->device_name)->plainTextToken;

   return response()->json([
   'token' => $token,
   'user' => $user->only('id','name','email','username','first_name','known_as','student_number','dob','year','age','gender','rotation_group','workshop_group','car_owner','gp_teacher','facilitator_id','locations_id','created_at','link','category_id','user_id'),
   ], 201);

});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json('logged out', 200);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user()->ldap;
//});


Route::middleware('api')->group(function () {
    Route::resource('notes', NotesController::class);
});

Route::group(['middleware' => ['cors']], function () {
             Route::resource('dicom', DicomController::class);
             //http://localhost:8081
});
//register user
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'username' => 'required|min:8|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);
 $user = User::create([
                      
   'name' => $request->name,
   'email' => $request->email,
   'username' => $request->username,
   'password' => Hash::make($request->password),
   ]);
  return response()->json($user, 201);

});

//Route::post('email',  ForgotPasswordController::class);
//Route::post('password/email',  ForgotPasswordController::class);
//Route::post('password/code/check', CodeCheckController::class);
//Route::post('password/reset', ResetPasswordController::class);


Route::get('Student', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. .
    return Student::all();
});






Route::get('Video', function() {
    return Video::all();
});

Route::get('Workshops', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure.
    return Workshops::all();
});

Route::get('GPTeachers', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure.
    return GPTeacher::all();
});

Route::get('Location', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure.
   return Location::all();
});

Route::get('User', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure.
   return User::all();
});

Route::get('Dissection', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. .
    return Dissection::all();
           
});



Route::get('Notes', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. .
    return Notes::all();
});

//Route::get('/notes', 'DataController@index');


//Route::get('/', function () {
//   \App\Models\Notes::create([
//        'status' => \App\Enum\StatusEnum::Module101,
//        //'full_name' => 'Aziz Sancar',
//    ]);
//});


Route::get('PathPots', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. .
    return PathPots::all();
});

Route::get('/categories', function () {
    return Category::all();
});

Route::get('dicom', function () {
    return Dicom::all();
});
Route::get('biomedengs', function () {
    return Biomedeng::all();
});
Route::get('spotters', [SpottersController::class, 'index']);

Route::get('physquiz', [PhysquizController::class, 'index']);

//Route::get('physquiz', function() {
//    // If the Content-Type and Accept headers are set to 'application/json',
//    // this will return a JSON structure. .
//    return Physquiz::all();
//});

Route::prefix('placements.bsms.ac.uk')->get('/Notes', function () {
    // This route will be generated as `/admin/users`
    return Notes::all();
});

// In your routes/web.php or routes/api.php file
//Route::get('dicom/{filename}', [DicomController::class, 'download']);


Route::post('/upload-content-with-package',[VideoController::class,'uploadContentWithPackage'])->name('upload.content.with.package');


Route::middleware('api')->group(function () {
    Route::resource('notes', NotesController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('dissections', VideoController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('users', UserController::class);
});

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password', [NovaResetPasswordController::class, 'showResetForm']);

Route::get('3d-models', function() {
    return Physquiz::select('id', 'name', 'urlCode')->get();
           //return Physquiz::all();
});

 /*Route::get('placements', function() {
 
    $validated = request()->validate([
        //'surgery' => ['required', 'string'],
        'name' => ['required', 'string'],
    ]);
    $user = Student::firstWhere('name', $validated['name'] );
    return $user->placements;

 
});*/

// 2026 Attendance System API Routes
Route::get('monitored-sessions', function() {
    $sessions = MonitoredSessions2026::orderBy('ClinicalSubType')->orderBy('SessionTitle')->get();
    
    $grouped = [];
    foreach ($sessions as $session) {
        $group = $session->ClinicalSubType ?: 'Other';
        if (!isset($grouped[$group])) {
            $grouped[$group] = [];
        }
        $grouped[$group][] = [
            'id' => $session->ID,
            'module_code' => $session->ModuleCode,
            'session_title' => $session->SessionTitle,
            'clinical_sub_type' => $session->ClinicalSubType,
        ];
    }
    
    return response()->json($grouped);
});

Route::get('session-attendance', function() {
    return SessionAttendance2026::all();
});

Route::middleware('auth:sanctum')->post('session-attendance', function(Request $request) {
    $validated = $request->validate([
        'bsms_id' => 'required|string|max:255',
        'session_date' => 'required|date',
        'session_id' => 'required|exists:MonitoredSessions2026,ID',
    ]);
    
    return SessionAttendance2026::create($validated);
});

// Location and Signoff Routes
Route::get('locations2025', function() {
    return Location2025::all();
});

Route::get('location-signoffs', function() {
    return LocationSignoff::all();
});

Route::middleware('auth:sanctum')->post('location-signoffs', function(Request $request) {
    $validated = $request->validate([
        'location_barcode' => 'required|string|max:255',
        'bsms_id' => 'required|string|max:255',
        'reg_number_of_approver' => 'nullable|string|max:255',
        'signoff_name' => 'nullable|string|max:255',
        'signature_svg' => 'nullable|string',
        'location_id' => 'required|exists:locations2025,id',
        'location_postcode' => 'nullable|string|max:255',
    ]);
    
    return LocationSignoff::create($validated);
});

// Examination Routes
Route::get('examinations', function() {
    return Examination::where('active', true)->orderBy('sort_order')->get();
});

Route::get('examination-results', function() {
    return ExaminationResult::all();
});

Route::middleware('auth:sanctum')->post('examination-results', function(Request $request) {
    $validated = $request->validate([
        'examination_id' => 'required|exists:examinations,id',
        'bsms_id' => 'required|string|max:255',
        'is_competent' => 'required|boolean',
        'assessed_at' => 'required|date',
    ]);
    
    return ExaminationResult::create($validated);
});

// Staff and Group Routes
Route::get('phase-one-staff', function() {
    return PhaseOneStaff::all();
});

Route::get('clinical-groups', function() {
    return ClinicalGroup::all();
});

Route::get('external-sites', function() {
    return ExternalSite::all();
});

// App Feedback Routes
Route::middleware('auth:sanctum')->post('app-feedback', function(Request $request) {
    $validated = $request->validate([
        'bsms_id' => 'required|string|max:255',
        'student_name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'feedback_type' => 'required|string|in:bug,feature,general,complaint,praise',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
        'rating' => 'nullable|integer|min:1|max:5',
        'app_version' => 'nullable|string|max:50',
        'device_info' => 'nullable|string|max:255',
    ]);
    
    return AppFeedback::create($validated);
});

Route::get('app-feedback', function() {
    return AppFeedback::orderBy('created_at', 'desc')->get();
});



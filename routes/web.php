<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepagecontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CustomerListTodayController;
use App\Http\Controllers\listAllCustomerController;
use App\Http\Controllers\BookingDetailsController;
use App\Http\Controllers\ListCustomerExpiredController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\listAllCarController;
use App\Http\Controllers\listAllRoomController;
use App\Http\Controllers\TodayCarController;
use App\Http\Controllers\TodayRoomController;
use App\Http\Controllers\listAllDoctorController;
use App\Http\Controllers\listAllUserController;
use App\Http\Controllers\listAllAppointmentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/home', [App\Http\Controllers\HomepageController::class, 'indexadmin']);

//route for admin & doctor
Route::get('/dashboard',[\App\Http\Controllers\dashboardController::class,'index']);

//display list 
Route::resource('/',HomepageController::class);
Route::get('/', [App\Http\Controllers\HomepageController::class,'index']);
Route::get('/search', [App\Http\Controllers\HomepageController::class,'search']);

//dependant dropdown
Route::get('/getProvider',[App\Http\Controllers\Homepagecontroller::class,'fetch']);
Route::get('/getCompany',[App\Http\Controllers\Homepagecontroller::class,'fetchCompany']);

//user choose specific booking
Route::get('/booking/{providerId}/{id}',[App\Http\Controllers\HomepageController::class,'show'])->name('booking');

//parse json to get time available
Route::post('/getTime',[App\Http\Controllers\HomepageController::class,'getTime'])->name('getTime');
Route::post('/getTimeCar',[App\Http\Controllers\HomepageController::class,'getTimeCar'])->name('getTimeCar');

//store appointment
Route::post('/booking/appointment',[App\Http\Controllers\HomepageController::class,'store'])->name('userAppointment');
Route::post('/carBooking',[App\Http\Controllers\HomepageController::class,'carBooking'])->name('carBooking');
Route::post('/roomBooking',[App\Http\Controllers\HomepageController::class,'roomBooking'])->name('roomBooking');

//update profile user
Route::resource('/user-profile',ProfileController::class);
Route::post('/user-profile-update',[App\Http\Controllers\ProfileController::class,'update']);

//schedule timing
Route::resource('/schedule', ScheduleController::class);
//update schedule
Route::post('/schedule-update',[App\Http\Controllers\ScheduleController::class,'update'])->name('schedule');

//patientlist for today
Route::resource('/patientToday',CustomerListTodayController::class);
Route::post('/patientToday-update',[App\Http\Controllers\CustomerListTodayController::class,'update']);
Route::post('/patientToday-cancel',[App\Http\Controllers\CustomerListTodayController::class,'cancelBooking']);

//allcustomer
Route::resource('/allPatient',listAllCustomerController::class);
Route::post('/allPatient-update',[App\Http\Controllers\listAllCustomerController::class,'update']);
Route::post('/allPatient-cancel',[App\Http\Controllers\listAllCustomerController::class,'cancelBooking']);

//expired Customer
Route::resource('/expired',ListCustomerExpiredController::class);

//booking details
Route::get('/myBooking',[App\Http\Controllers\BookingDetailsController::class,'index']);
Route::get('/BookingDetails/{appointmentsId}',[App\Http\Controllers\BookingDetailsController::class,'BookingDetails']);
Route::get('/booking-user-cancel/{id}',[App\Http\Controllers\BookingDetailsController::class,'update']);

//admin create car provider
Route::resource('/create-Car',ProviderController::class);
Route::post('/create-Car',[App\Http\Controllers\ProviderController::class,'store'])->name('createCar');

//admin create meeting room provider
Route::get('/meetingRoom-edit/{$id}',[App\Http\Controllers\ProviderController::class,'roomEdit']);
Route::get('/create-MeetingRoom',[App\Http\Controllers\ProviderController::class,'create2'])->name('MeetingRoom');
Route::post('/create-MeetingRoom',[App\Http\Controllers\ProviderController::class,'store2'])->name('createMeetingRoom');

//listing all car
Route::resource('/allCar',listAllCarController::class);
Route::post('/allCar',[App\Http\Controllers\listAllCarController::class,'update']);

//listing Meeting room
Route::resource('/allMeetingRoom',listAllRoomController::class);
Route::post('/allMeetingRoom',[App\Http\Controllers\listAllRoomController::class,'update']);

//listing car today 
Route::resource('/today',TodayCarController::class);
Route::post('/booking-car-cancel',[App\Http\Controllers\TodayCarController::class,'updatecancel']);
Route::post('/booking-car-app',[App\Http\Controllers\TodayCarController::class,'updateapp']);
Route::get('/admin-car-cancel/{id}',[App\Http\Controllers\TodayCarController::class,'admincancel']);
Route::get('/admin-car-app/{id}',[App\Http\Controllers\TodayCarController::class,'adminapp']);

//listing meeting room today
Route::resource('/today-room', TodayRoomController::class);
Route::post('/booking-room-cancel',[App\Http\Controllers\TodayRoomController::class,'update']);
Route::post('/booking-room-app',[App\Http\Controllers\TodayRoomController::class,'updateapp']);
Route::get('/admin-room-cancel/{id}',[App\Http\Controllers\TodayRoomController::class,'admincancel']);
Route::get('/admin-room-app/{id}',[App\Http\Controllers\TodayRoomController::class,'adminapp']);

Route::resource('/alldoctor',listAllDoctorController::class);
Route::post('/Create-doctor',[App\Http\Controllers\listAllDoctorController::class,'store'])->name('createDoctor');

Route::resource('/allCustomer',listAllUserController::class);

Route::resource('/allappointment',listAllAppointmentController::class);

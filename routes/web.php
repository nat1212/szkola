<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventDetailsController;
use App\Http\Controllers\EventParticipantController;
use App\Http\Controllers\EventServicesController;
use App\Models\EventService;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::middleware(['auth','verified'])->group(function(){
    Route::get('create', function () {
        return view('create');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    

Route::get('/event/list',[EventController::class,'index'])->name('event.list')->middleware('auth');
Route::delete('/event/{id}',[EventController::class,'destroy']);

Route::delete('event-details/{id}', [EventDetailsController::class, 'destroy']);
Route::get('/event/edit_details/{event}',[EventDetailsController::class,'edit'])->name('event.edit_details')->middleware('auth');
Route::post('edit_details/{event}',[EventDetailsController::class,'update'])->name('edit_details.update')->middleware('auth');;

Route::get('/event/edit/{event}',[EventController::class,'edit'])->name('event.edit')->middleware('auth');
Route::get('create',[EventController::class,'create'])->name('create')->middleware('auth');
Route::get('event/{event}',[EventController::class,'show'])->name('event.show')->middleware('auth');;

Route::post('create/{event}',[EventController::class,'update'])->name('create.update')->middleware('auth');;
Route::post('create',[EventController::class,'store'])->name('create.store')->middleware('auth');;

Route::get('list',[EventController::class,'show']);

Route::get('event/{id}',[EventController::class,'showall']);

Route::post('/update/{id}', [EventServicesController::class,'updateData'])->name('updateData');





//Route::get('/create2',[EventDetailsController::class,'create2']);
Route::get('/create2/{id}',[EventDetailsController::class,'create2'])->name('create2')->middleware('auth');
Route::post('/create2',[EventDetailsController::class,'store']);

Route::get('/addMember/{id}',[EventServicesController::class,'addMember'])->name('addMember')->middleware('auth');
Route::post('/addMember',[EventServicesController::class,'store']);

Route::delete('event-services/{id}', [EventServicesController::class, 'destroy']);

Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/first_name/{id}', [UserController::class, 'updateFirstName'])->name('user.updateFirstName');
Route::post('/user/update/last_name/{id}', [UserController::class, 'updateLastName'])->name('user.updateLastName');
Route::get('/events/search', [EventController::class,'search'])->name('events.search');
Route::get('/user_list',[EventController::class,'user_list'])->name('user_list')->middleware('auth');

Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
Route::get('/zmien-haslo', [App\Http\Controllers\HomeController::class, 'zmienHaslo'])->name('zmien-haslo');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/{id}/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');

Route::get('event_info/{id}',[EventController::class,'event_info'])->name('event_info')->middleware('auth');

/*Route::get('/zapisz/{id}',[EventParticipantController::class,'zapisz'])->name('zapisz');
Route::get('/list/{id}',[EventParticipantController::class,'list'])->name('list');
Route::post('/zapisz',[EventParticipantController::class,'store']);
Route::post('/edit',[eventParticipantController::class,'edit']);

Route::delete('list/{id}', [eventParticipantController::class, 'destroy']);
Route::delete('list-xd/{id}', [eventParticipantController::class, 'delete']);
*/
//LISTY
Route::get('/zapisz/{id}',[EventParticipantController::class,'zapisz'])->name('zapisz');
Route::get('/zapisznr/{id}',[EventParticipantController::class,'zapisznr'])->name('zapisznr');
Route::post('/zapisz',[EventParticipantController::class,'store']);
Route::post('/zapisznr',[EventParticipantController::class,'storenr']);

Route::get('/list/{id}',[EventParticipantController::class,'list'])->name('list');
Route::get('/listnr/{id}',[EventParticipantController::class,'listnr'])->name('listnr');

Route::post('/edit',[EventParticipantController::class,'edit']);
Route::post('/edit2',[EventParticipantController::class,'edit2']);
Route::post('/edit3',[EventParticipantController::class,'edit3']);

Route::delete('list/{id}', [EventParticipantController::class, 'destroy']);

Route::delete('list-xd/{id}', [EventParticipantController::class, 'delete']);

Route::delete('listnr-nr/{id}', [EventParticipantController::class, 'deletenr']);



Route::get('/leave/{entryId}',[eventParticipantController::class,'leave']);
Route::post('/signup', [eventParticipantController::class, 'signup']);

});




//Route::middleware()

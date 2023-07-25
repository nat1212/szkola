<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailsController;
use App\Http\Controllers\EventServicesController;
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
Route::middleware(['auth','verified'])->group(function(){
   

});

Route::get('create', function () {
    return view('create');
});


Route::get('/event/list',[EventController::class,'index'])->name('event.list')->middleware('auth');
Route::delete('/event/{id}',[EventController::class,'destroy'])->middleware('auth');

Route::delete('event-details/{id}', [EventDetailsController::class, 'destroy']);
Route::get('/event/edit_details/{event}',[EventDetailsController::class,'edit'])->name('event.edit_details')->middleware('auth');

Route::get('/event/edit/{event}',[EventController::class,'edit'])->name('event.edit')->middleware('auth');
Route::get('create',[EventController::class,'create'])->name('create')->middleware('auth');
Route::get('event/{event}',[EventController::class,'show'])->name('event.show')->middleware('auth');;

Route::post('create/{event}',[EventController::class,'update'])->name('create.update')->middleware('auth');;
Route::post('create',[EventController::class,'store'])->name('create.store')->middleware('auth');;

Route::get('list',[EventController::class,'show']);

Route::get('event/{id}',[EventController::class,'showall']);

//Route::get('/create2',[EventDetailsController::class,'create2']);
Route::get('/create2/{id}',[EventDetailsController::class,'create2'])->name('create2')->middleware('auth');
Route::post('/create2',[EventDetailsController::class,'store']);

Route::get('/addMember/{id}',[EventServicesController::class,'addMember'])->name('addMember')->middleware('auth');
Route::post('/addMember',[EventServicesController::class,'store']);

Auth::routes(['verify'=>true]);
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::middleware()

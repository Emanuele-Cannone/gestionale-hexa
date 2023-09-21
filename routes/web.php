<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ComunicationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Progen\ProgenCustomerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RosterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /** Localization */
    Route::get('change/{language:locale}', [LanguageController::class, 'changeLocale'])
        ->name('change.language');

    Route::resource('attendances', AttendanceController::class);

    // Roster routes
    Route::resource('rosters', RosterController::class);
    Route::post('downloadRosterEmptyFile', [RosterController::class, 'downloadEmptyFile'])->name('downloadRosterEmptyExcel');
    Route::post('importRosterFile', [RosterController::class, 'importRosterFile'])->name('importRosterFile');

    // Progen routes
    Route::resource('progen', ProgenCustomerController::class);
    Route::put('updateCustomerUsers/{id}', [ProgenCustomerController::class, 'updateCustomerUsers'])->name('progen.updateCustomerUsers');

    // Question routes
    Route::resource('questions', QuestionController::class);

    Route::resource('comunications', ComunicationController::class);

    // Routes protected by role
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('roles', RoleController::class);
    });
});

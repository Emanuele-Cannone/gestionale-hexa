<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ComunicationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Progen\ProgenCustomerController;
use App\Http\Controllers\Progen\ProgenProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\UserController;
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

    Route::resource('progen-products', ProgenProductController::class);

    // Question routes
    Route::resource('questions', QuestionController::class);

    // Comunication routes
    Route::resource('comunications', ComunicationController::class);

    // Routes protected by permission - ASSIGN PERMISSION ROLE
    Route::group(['middleware' => ['permission:assign permission role']], function () {

        Route::resource('roles', RoleController::class);
        Route::get('user-role', [RoleController::class, 'getUserRole'])->name('user-role');
        Route::get('role-monitor', [RoleController::class, 'roleMonitor'])->name('role-monitor');

        Route::resource('permissions', PermissionController::class);
        Route::get('user-permission/{id}', [PermissionController::class, 'getUserPermission'])->name('user-permission');

        Route::get('/manage-people', function () {
            return view('manage-people');
        })->name('manage-people');
    });

    // Routes protected by permission - CREATE USER
    Route::group(['middleware' => ['permission:create user']], function () {

        // User routes
        Route::resource('users', UserController::class);
        Route::post('users/export/', [UserController::class, 'export'])->name('users-export');


    });


});

<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//for users
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'user'], function () {
    // View all users
    Route::get('/users-index', [UserController::class, 'index'])->name('user.index');
    
    // View a specific user
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    
    // Delete a user
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
    // Update a user
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    
});

Route::group(['prefix' => 'email'], function () {
    // pass selected users to the compose email view
    Route::post('/submit-selected-users', [EmailController::class, 'submitSelectedUsers'])->name('submit-selected-users');
    // send email
    Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send-email');;
});

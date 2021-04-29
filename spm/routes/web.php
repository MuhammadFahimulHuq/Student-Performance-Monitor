<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('pages.test');
// });

Route::get('/dd', [Registration::class,'deadCall'])->name('dd');
Route::get('/registration', [Registration::class, 'reg'])->name('registraton');
Route::POST('/valideteReg', [Registration::class, 'validating'])->name('validationReg');
Route::get('/populate', [Registration::class, 'populateDatabase'])->name('populate');

Route::get('/', [Dashboard::class, 'login'])->name('login');
Route::POST('/', [Dashboard::class, 'validation'])->name('validationLogin');
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');


Route::get('/studentdashboard', function () {
    return view('pages/studentdashboard');
});

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
